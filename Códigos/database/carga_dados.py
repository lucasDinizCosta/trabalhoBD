#python -m pip install mysql-connector
#python -m pip install rstr

import mysql.connector
from mysql.connector import Error

import random, rstr, datetime, string

NUM_INSERTS	= 50

# PROP: Filial, Evento, Fornecedor, Depósito
PROP	 			= 0.2

PROP_CLIENTE		= 0.2
PROP_FUNCIONARIO	= 0.2
PROP_GERENTE		= 0.05

NUM_OUTROS 		= int(NUM_INSERTS * PROP)
NUM_CLIENTE 	= int(NUM_INSERTS * PROP_CLIENTE)
NUM_FUNCIONARIO = int(NUM_INSERTS * PROP_FUNCIONARIO)
NUM_GERENTE 	= int(NUM_INSERTS * PROP_GERENTE)

NUM_CONVIDADO	= 10

def gen_age():
	return random.randint(15, 99)

def gen_boolean():
	return random.randint(0, 1)

def gen_foreing_key(type):
	if(type == 'deposito'):
		return random.randint(1, NUM_OUTROS)
	elif(type == 'filial'):
		return random.randint(1, NUM_OUTROS)
	elif(type == 'fornecedor'):
		return random.randint(1, NUM_OUTROS)
	elif(type == 'cliente'):
		return random.randint(1, NUM_CLIENTE)
	elif(type == 'funcionario'):
		return random.randint(NUM_CLIENTE+1, NUM_CLIENTE+NUM_FUNCIONARIO)
	elif(type == 'gerente'):
		return random.randint(NUM_FUNCIONARIO+NUM_CLIENTE+1, NUM_FUNCIONARIO+NUM_CLIENTE+NUM_GERENTE)

def gen_cnpj():
	return '{0}.{1}.{2}/0001-{3}'.format(rstr.rstr('1234567890', 2),
										 rstr.rstr('1234567890', 3),
										 rstr.rstr('1234567890', 3),
										 rstr.rstr('1234567890', 2))

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

'''
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
'''

def gen_duration():
	hour 		= random.randint(2, 5)
	minute 		= random.choice([0, 15, 30, 45])
	second		= 0

	return str(hour)+':'+str(minute)+':'+str(second)

def gen_date():
	year 		= random.randint(1980, 2018)
	month 		= random.randint(1, 12)
	day 		= random.randint(1, 28)
	hour 		= random.randint(12, 20)
	minute 		= random.choice([0, 15, 30, 45])

	date = datetime.datetime(year, month, day, hour, minute).isoformat(" ")
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
	letters = string.ascii_uppercase[:25]
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

def gen_gerencia():
	list_gerencia = [
		'Diretoria', 'Intermediária', 'Operacional'
	]
	return random.choice(list_gerencia)

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

sql = "SET FOREIGN_KEY_CHECKS=0"
cursor.execute(sql)
conn.commit()

for i in range(NUM_INSERTS):
	rua 	= gen_street()
	numero 	= gen_number()
	cidade 	= gen_city()
	cep 	= gen_cep()

	if(i < NUM_OUTROS):

		#-----------------------------------FILIAL---------------------------------------

		nome = gen_letters_uppercase()

		sql 	= "INSERT INTO filial (nome, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s)"
		values 	= (nome, rua, numero, cidade, cep)

		cursor.execute(sql, values)
		conn.commit()

		#-----------------------------------EVENTO---------------------------------------

		data = gen_date()
		duracao = gen_duration()
		preco = gen_salary()
		id_filial = gen_foreing_key('filial')
		id_cliente = gen_foreing_key('cliente')

		sql 	= "INSERT INTO evento (data, duracao, preco, id_filial, id_cliente) VALUES (%s, %s, %s, %s, %s)"
		values 	= (data, duracao, preco, id_filial, id_cliente)

		cursor.execute(sql, values)
		conn.commit()

		id_evento = cursor.lastrowid

		#----------------------------------CONVIDADO-------------------------------------

		for aux in range(NUM_CONVIDADO):
			nome = gen_name()+' '+gen_letters_uppercase()+'.'+' '+gen_letters_uppercase()+'.'

			sql 	= "INSERT INTO convidado (nome, id_evento) VALUES (%s, %s)"
			values 	= (nome, id_evento)

			cursor.execute(sql, values)
			conn.commit()

		#----------------------------------FORNECEDOR------------------------------------

		razao_social 	= gen_name()
		cnpj 			= gen_cnpj()

		rua 			= gen_street()
		numero 			= gen_number()
		cidade 			= gen_city()
		cep 			= gen_cep()

		sql 	= "INSERT INTO fornecedor (razao_social, cnpj, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s, %s)"
		values 	= (razao_social, cnpj, rua, numero, cidade, cep)

		cursor.execute(sql, values)
		conn.commit()

		#----------------------------------DEPOSITO-------------------------------------

		rua 			= gen_street()
		numero 			= gen_number()
		cidade 			= gen_city()
		cep 			= gen_cep()

		sql 	= "INSERT INTO deposito (rua, numero, cidade, cep) VALUES (%s, %s, %s, %s)"
		values 	= (rua, numero, cidade, cep)

		cursor.execute(sql, values)
		conn.commit()

	elif(i < NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE):

		#-----------------------------------PESSOA--------------------------------------

		nome 		= gen_name()
		email 		= gen_email()
		telefone 	= gen_phone()
		cpf 		= gen_cpf()

		sql 	= "INSERT INTO pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
		values 	= (nome, email, telefone, cpf, rua, numero, cidade, cep)

		cursor.execute(sql, values)
		conn.commit()

		id_pessoa = cursor.lastrowid

		if(i < NUM_OUTROS + NUM_CLIENTE):

			#--------------------------------CLIENTE-----------------------------------

			credito_disponivel = gen_credit()

			sql 	= "INSERT INTO cliente (credito_disponivel, id_pessoa) VALUES (%s, %s)"
			values 	= (credito_disponivel, id_pessoa)

			cursor.execute(sql, values)
			conn.commit()

		else:

			#------------------------------FUNCIONARIO---------------------------------

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

			#--------------------------------GERENTE-----------------------------------

			aux_1 = NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO
			aux_2 = NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE

			if(aux_1 <= i and i < aux_2):
				turno 	= gen_shift()
				grau 	= gen_gerencia()

				sql 	= "INSERT INTO gerente (turno, grau, id_pessoa) VALUES (%s, %s, %s)"
				values 	= (turno, grau, id_pessoa)

				cursor.execute(sql, values)
				conn.commit()
				

sql = "SET FOREIGN_KEY_CHECKS=1"
cursor.execute(sql)
conn.commit()

'''
sql = "SELECT * FROM filial"

cursor.execute(sql)

result = cursor.fetchall()

for i in result:
	print(i)
'''