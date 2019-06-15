#python -m pip install mysql-connector
#python -m pip install rstr

import mysql.connector
from mysql.connector import Error

import random, rstr, datetime, string

NUM_INSERTS	= 50

PROP_FILIAL	 		= 0.1
PROP_CLIENTE		= 0.6
PROP_FUNCIONARIO	= 0.35
PROP_GERENTE		= 0.05

NUM_FILIAL 		= int(NUM_INSERTS * PROP_FILIAL)
NUM_CLIENTE 	= int(NUM_INSERTS * PROP_CLIENTE)
NUM_FUNCIONARIO = int(NUM_INSERTS * PROP_FUNCIONARIO)
NUM_GERENTE 	= int(NUM_INSERTS * PROP_GERENTE)

def gen_age():
	return random.randint(15, 99)

def gen_boolean():
	return random.randint(0, 1)

def gen_foreing_key(type):
	if(type == 'filial'):
		return random.randint(1, NUM_FILIAL)
	elif(type == 'cliente'):
		return random.randint(1, NUM_CLIENTE)
	elif(type == 'funcionario'):
		return random.randint(NUM_CLIENTE+1, NUM_CLIENTE+NUM_FUNCIONARIO)
	elif(type == 'gerente'):
		return random.randint(NUM_FUNCIONARIO+NUM_CLIENTE+1, NUM_FUNCIONARIO+NUM_CLIENTE+NUM_GERENTE)

def gen_cpf():
	return '{0}.{1}.{2}-{3}'.format(rstr.rstr('1234567890', 3),
									rstr.rstr('1234567890', 3),
									rstr.rstr('1234567890', 3),
									rstr.rstr('1234567890', 2))

def gen_cep():
	return '{0}-{1}'.format(rstr.rstr('1234567890', 5),
							rstr.rstr('1234567890', 3))

def gen_phone():
	return '{0} {1}-{2}'.format(rstr.rstr('1234567890', 2),
								rstr.rstr('1234567890', 4),
								rstr.rstr('1234567890', 4))

def gen_number():
	return rstr.rstr('1234567890', 3)

def gen_salary():
	return '{0}.{1}'.format(rstr.rstr('1234567890', 5),
							rstr.rstr('1234567890', 2))

def gen_credit():
	return '{0}.00'.format(rstr.rstr('1234567890', 3))

def gen_timestamp():
	year 		= random.randint(1980, 2018)
	month 		= random.randint(1, 12)
	day 		= random.randint(1, 28)
	hour 		= random.randint(0, 23)
	minute 		= random.randint(0, 59)
	second		= random.randint(0, 59)
	#microsecond = random.randint(0, 999999)

	date = datetime.datetime(year, month, day, hour, minute, second).isoformat(" ")
	return date

def gen_city():
	list_city = [
		['Sao Paulo', 		'SP'],
		['Rio de Janeiro', 	'RJ'],
		['Porto Alegre', 	'RS'],
		['Campo Grande', 	'MS'],
		['Belo Horizonte', 	'MG'],
		['Juiz de Fora', 	'MG']
	]
	return random.choice(list_city)[0] #Retorna apenas a Cidade

def gen_letters_uppercase():
	letters = string.ascii_uppercase[:20]
	return random.choice(letters)

def gen_letters_lowercase():
	letters = string.ascii_lowercase[:20]
	return ''.join(random.choice(letters) for i in range(10))

def gen_street():
	return 'Rua '+gen_letters_uppercase()

def gen_name():
	first_name = [
		'Joao', 		'Angelo', 	'Kevyn',
		'Lucas', 		'Mateus', 	'Pedro',
		'Bruno', 		'Rodrigo', 	'Mariana',
		'Ana', 			'Andreza', 	'Marina',
		'Isis', 		'Natiele', 	'Cecilia',
		'Franciane', 	'Veronica', 'Douglas',
		'Cleverson', 	'Carlos', 	'Henrique',
		'Paola', 		'Joaquim'
	]
	last_name = [
		'Silva', 	'Ribeiro', 	'Diniz',
		'Santos', 	'Carvalho', 'Costa',
		'Ambrosio'
	]
	return random.choice(first_name)+' '+random.choice(last_name)

def gen_job():
	list_job = [
		'Atendente', 'Gerente', 'Limpeza', 'Garcom', 'Caixa', 'Cozinheiro',
		'Manobrista'
	]
	return random.choice(list_job)

def gen_email():
	domains = [ 'hotmail.com', 'gmail.com', 'ice.ufjf.br', 'yahoo.com']
	letters = string.ascii_lowercase[:20]

	name = ''.join(random.choice(letters) for i in range(8))

	return name+'@'+random.choice(domains)

def gen_shift():
	list_shift = [
		'Diurno', 'Noturno', 'Integral'
	]
	return random.choice(list_shift)

conn = mysql.connector.connect(
	host="localhost",
	user="root",
	passwd=""
)

cursor = conn.cursor()

with open('lanchonete_script.sql', 'r') as file:
	for cont, line in enumerate(file.readlines()):
		if(cont == 2):
			conn = mysql.connector.connect(
				host='localhost',
				database='lanchonete',
				user='root',
				password='',
				charset = 'utf8'
			)
			cursor = conn.cursor()

		cursor.execute(line)
		conn.commit()

for i in range(NUM_INSERTS):
	rua 		= gen_street()
	numero 		= gen_number()
	cidade 		= gen_city()
	cep 		= gen_cep()

	if(i < NUM_FILIAL):
		nome = gen_letters_uppercase()

		sql 	= "INSERT INTO filial (nome, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s)"
		values 	= (nome, rua, numero, cidade, cep)

		cursor.execute(sql, values)

	elif(i < NUM_FILIAL + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE):
		nome 		= gen_name()
		email 		= gen_email()
		telefone 	= gen_phone()
		cpf 		= gen_cpf()

		sql 	= "INSERT INTO pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
		values 	= (nome, email, telefone, cpf, rua, numero, cidade, cep)

		cursor.execute(sql, values)
		conn.commit()

		id_pessoa = cursor.lastrowid

		if(i < NUM_FILIAL + NUM_CLIENTE):
			credito_disponivel = gen_credit()

			sql 	= "INSERT INTO cliente (credito_disponivel, id_pessoa) VALUES (%s, %s)"
			values 	= (credito_disponivel, id_pessoa)

			cursor.execute(sql, values)
			conn.commit()

		else:
			cargo		= gen_job()
			salario		= gen_salary()
			login		= gen_letters_lowercase()
			senha		= gen_letters_lowercase()
			status		= gen_boolean()
			id_filial	= gen_foreing_key('filial')


			sql 	= "INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES (%s, %s, %s, %s, %s, %s, %s)"
			values 	= (cargo, salario, login, senha, status, id_filial, id_pessoa)

			cursor.execute(sql, values)
			conn.commit()

			if(i < NUM_FILIAL + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE):
				turno 	= gen_shift()
				grau 	= gen_boolean()

				sql 	= "INSERT INTO gerente (turno, grau, id_pessoa) VALUES (%s, %s, %s)"
				values 	= (turno, grau, id_pessoa)

				cursor.execute(sql, values)
				conn.commit()


'''
sql = "SELECT * FROM filial"

cursor.execute(sql)

result = cursor.fetchall()

for i in result:
	print(i)
'''