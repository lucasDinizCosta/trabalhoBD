#python -m pip install mysql-connector
#python -m pip install rstr

import mysql.connector
from mysql.connector import Error

import random, rstr, datetime, string

NUM_INSERTS	= 200

# PROP: Filial, Evento, Fornecedor, Depósito, Ingrediente, Produto, Combo, Venda
PROP	 			= 0.2

PROP_N_N			= 0.2

PROP_CLIENTE		= 0.3
PROP_FUNCIONARIO	= 0.2
PROP_GERENTE		= 0.1

NUM_OUTROS 		= int(NUM_INSERTS * PROP)
NUM_N_N 		= int(NUM_INSERTS * PROP_N_N)
NUM_CLIENTE 	= int(NUM_INSERTS * PROP_CLIENTE)
NUM_FUNCIONARIO = int(NUM_INSERTS * PROP_FUNCIONARIO)
NUM_GERENTE 	= int(NUM_INSERTS * PROP_GERENTE)

NUM_CONVIDADO	= 10

def gen_age():
	return random.randint(15, 99)

def gen_boolean():
	return random.randint(0, 1)

def gen_foreing_key(type):
	if( type == 'deposito'		or 	type == 'filial'	or 	type == 'fornecedor'	or
		type == 'ingrediente'	or 	type == 'produto'	or 	type == 'combo' 		or
		type == 'venda'):
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

def gen_number(size=3):
	return rstr.rstr('123456789', size)

def gen_value(integer):
	return '{0}.{1}'.format(rstr.rstr('123456789', integer),
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


def try_insert(sql, values):
	try:
		cursor.execute(sql, values)
		conn.commit()

		return True

	except:
		return False


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

with open('carga_dados.sql', 'w') as file:

	sql = "SET FOREIGN_KEY_CHECKS=0"
	cursor.execute(sql)
	conn.commit()

	file.write(sql + ";\n")

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

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.filial (nome, rua, numero, cidade, cep) VALUES " + str(values) + ";\n")


			#-----------------------------------EVENTO---------------------------------------

			data = gen_date()
			duracao = gen_duration()
			preco = gen_value(integer=4)
			id_filial = gen_foreing_key('filial')
			id_cliente = gen_foreing_key('cliente')

			sql 	= "INSERT INTO evento (data, duracao, preco, id_filial, id_cliente) VALUES (%s, %s, %s, %s, %s)"
			values 	= (data, duracao, preco, id_filial, id_cliente)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.evento (data, duracao, preco, id_filial, id_cliente) VALUES " + str(values) + ";\n")

			id_evento = cursor.lastrowid

			#----------------------------------CONVIDADO-------------------------------------

			for aux in range(NUM_CONVIDADO):
				nome = gen_name()+' '+gen_letters_uppercase()+'.'+' '+gen_letters_uppercase()+'.'

				sql 	= "INSERT INTO convidado (nome, id_evento) VALUES (%s, %s)"
				values 	= (nome, id_evento)

				if(try_insert(sql, values)):
					file.write("INSERT INTO lanchonete.convidado (nome, id_evento) VALUES " + str(values) + ";\n")

			#----------------------------------FORNECEDOR------------------------------------

			razao_social 	= gen_name()
			cnpj 			= gen_cnpj()

			rua 			= gen_street()
			numero 			= gen_number()
			cidade 			= gen_city()
			cep 			= gen_cep()

			sql 	= "INSERT INTO fornecedor (razao_social, cnpj, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s, %s)"
			values 	= (razao_social, cnpj, rua, numero, cidade, cep)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.fornecedor (razao_social, cnpj, rua, numero, cidade, cep) VALUES " + str(values) + ";\n")

			#----------------------------------DEPOSITO-------------------------------------

			rua 			= gen_street()
			numero 			= gen_number()
			cidade 			= gen_city()
			cep 			= gen_cep()

			sql 	= "INSERT INTO deposito (rua, numero, cidade, cep) VALUES (%s, %s, %s, %s)"
			values 	= (rua, numero, cidade, cep)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.deposito (rua, numero, cidade, cep) VALUES " + str(values) + ";\n")

			#--------------------------------INGREDIENTE-----------------------------------

			nome 			= gen_letters_uppercase()
			preco_unitario	= gen_value(integer=1)

			sql 	= "INSERT INTO ingrediente (nome, preco_unitario) VALUES (%s, %s)"
			values 	= (nome, preco_unitario)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.ingrediente (nome, preco_unitario) VALUES " + str(values) + ";\n")

			#----------------------------------PRODUTO-------------------------------------

			nome	= gen_letters_uppercase()
			preco	= gen_value(integer=2)

			sql 	= "INSERT INTO produto (nome, preco) VALUES (%s, %s)"
			values 	= (nome, preco)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.produto (nome, preco) VALUES " + str(values) + ";\n")

			#-----------------------------------COMBO--------------------------------------

			nome	= gen_letters_uppercase()
			preco	= gen_value(integer=2)

			sql 	= "INSERT INTO combo (nome, preco) VALUES (%s, %s)"
			values 	= (nome, preco)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.combo (nome, preco) VALUES " + str(values) + ";\n")

			#-----------------------------------VENDA--------------------------------------

			data			= gen_date()
			nota_fiscal		= gen_number(size=11)
			id_cliente		= gen_foreing_key('cliente')
			id_funcionario 	= gen_foreing_key('funcionario')

			sql 	= "INSERT INTO venda (data, nota_fiscal, id_cliente, id_funcionario) VALUES (%s, %s, %s, %s)"
			values 	= (data, nota_fiscal, id_cliente, id_funcionario)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.venda (data, nota_fiscal, id_cliente, id_funcionario) VALUES " + str(values) + ";\n")

			#----------------------------------ENTREGA-------------------------------------

			rua 				= gen_street()
			cep 				= gen_cep()
			numero 				= gen_number()
			cidade 				= gen_city()
			frete				= gen_value(integer=1)
			nome_destinatario	= gen_name()
			id_venda 			= gen_foreing_key('venda')

			sql 	= "INSERT INTO entrega (rua, cep, numero, cidade, frete, nome_destinatario, id_venda) VALUES (%s, %s, %s, %s, %s, %s, %s)"
			values 	= (rua, cep, numero, cidade, frete, nome_destinatario, id_venda)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.entrega (rua, cep, numero, cidade, frete, nome_destinatario, id_venda) VALUES " + str(values) + ";\n")




		elif(i < NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE):

			#-----------------------------------PESSOA--------------------------------------

			nome 		= gen_name()
			email 		= gen_email()
			telefone 	= gen_phone()
			cpf 		= gen_cpf()

			sql 	= "INSERT INTO pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
			values 	= (nome, email, telefone, cpf, rua, numero, cidade, cep)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.pessoa (nome, email, telefone, cpf, rua, numero, cidade, cep) VALUES " + str(values) + ";\n")

			id_pessoa = cursor.lastrowid

			if(i < NUM_OUTROS + NUM_CLIENTE):

				#--------------------------------CLIENTE-----------------------------------

				credito_disponivel = gen_credit()

				sql 	= "INSERT INTO cliente (credito_disponivel, id_pessoa) VALUES (%s, %s)"
				values 	= (credito_disponivel, id_pessoa)

				if(try_insert(sql, values)):
					file.write("INSERT INTO lanchonete.cliente (credito_disponivel, id_pessoa) VALUES " + str(values) + ";\n")

			else:

				#------------------------------FUNCIONARIO---------------------------------

				cargo		= gen_job()
				salario		= gen_value(integer=4)
				login		= gen_letters_lowercase()
				senha		= gen_letters_lowercase()
				status		= gen_boolean()
				id_filial	= gen_foreing_key('filial')

				sql 	= "INSERT INTO funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES (%s, %s, %s, %s, %s, %s, %s)"
				values 	= (cargo, salario, login, senha, status, id_filial, id_pessoa)

				if(try_insert(sql, values)):
					file.write("INSERT INTO lanchonete.funcionario (cargo, salario, login, senha, status, id_filial, id_pessoa) VALUES " + str(values) + ";\n")

				#--------------------------------GERENTE-----------------------------------

				aux_1 = NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO
				aux_2 = NUM_OUTROS + NUM_CLIENTE + NUM_FUNCIONARIO + NUM_GERENTE

				if(aux_1 <= i and i < aux_2):
					turno 	= gen_shift()
					grau 	= gen_gerencia()

					sql 	= "INSERT INTO gerente (turno, grau, id_pessoa) VALUES (%s, %s, %s)"
					values 	= (turno, grau, id_pessoa)

					if(try_insert(sql, values)):
						file.write("INSERT INTO lanchonete.gerente (turno, grau, id_pessoa) VALUES " + str(values) + ";\n")


					

		if(i < NUM_N_N):

			#------------------------------DEPOSITO-FILIAL---------------------------------

			id_filial	= gen_foreing_key('filial')
			id_deposito	= gen_foreing_key('deposito')

			sql 	= "INSERT INTO deposito_filial (id_filial, id_deposito) VALUES (%s, %s)"
			values 	= (id_filial, id_deposito)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.deposito_filial (id_filial, id_deposito) VALUES " + str(values) + ";\n")


			#-------------------------ITEM-IGREDIENTE-DEPOSITO-----------------------------

			id_deposito		= gen_foreing_key('deposito')
			id_ingrediente	= gen_foreing_key('ingrediente')

			sql 	= "INSERT INTO item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES (%s, %s)"
			values 	= (id_deposito, id_ingrediente)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_ingrediente_deposito (id_deposito, id_ingrediente) VALUES " + str(values) + ";\n")

			#------------------------ITEM-IGREDIENTE-FORNECEDOR----------------------------

			id_fornecedor	= gen_foreing_key('fornecedor')
			id_ingrediente	= gen_foreing_key('ingrediente')

			sql 	= "INSERT INTO item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES (%s, %s)"
			values 	= (id_fornecedor, id_ingrediente)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_ingrediente_fornecedor (id_fornecedor, id_ingrediente) VALUES " + str(values) + ";\n")

			#---------------------------ITEM-PRODUTO-DEPOSITO------------------------------

			id_produto	= gen_foreing_key('produto')
			id_deposito		= gen_foreing_key('deposito')

			sql 	= "INSERT INTO item_produto_deposito (id_produto, id_deposito) VALUES (%s, %s)"
			values 	= (id_produto, id_deposito)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_produto_deposito (id_produto, id_deposito) VALUES " + str(values) + ";\n")

			#-------------------------ITEM-INGREDIENTE-PRODUTO-----------------------------

			quantidade  	= gen_number(size=1)
			id_ingrediente	= gen_foreing_key('ingrediente')
			id_produto		= gen_foreing_key('produto')

			sql 	= "INSERT INTO item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES (%s, %s, %s)"
			values 	= (quantidade, id_ingrediente, id_produto)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_ingrediente_produto (quantidade, id_ingrediente, id_produto) VALUES " + str(values) + ";\n")

			#-------------------------ITEM-PRODUTO-FORNECEDOR-----------------------------

			id_produto		= gen_foreing_key('produto')
			id_fornecedor	= gen_foreing_key('fornecedor')

			sql 	= "INSERT INTO item_produto_fornecedor (id_produto, id_fornecedor) VALUES (%s, %s)"
			values 	= (id_produto, id_fornecedor)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_produto_fornecedor (id_produto, id_fornecedor) VALUES " + str(values) + ";\n")

			#---------------------------ITEM-PRODUTO-COMBO-------------------------------

			quantidade		= gen_number(size=1)
			id_produto	= gen_foreing_key('produto')
			id_combo	= gen_foreing_key('combo')

			sql 	= "INSERT INTO item_produto_combo (quantidade, id_produto, id_combo) VALUES (%s, %s, %s)"
			values 	= (quantidade, id_produto, id_combo)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_produto_combo (quantidade, id_produto, id_combo) VALUES " + str(values) + ";\n")

			#---------------------------ITEM-PRODUTO-VENDA-------------------------------

			preco_unitario	= gen_value(integer=2)
			quantidade		= gen_number(size=1)
			id_produto 		= gen_foreing_key('produto')
			id_venda		= gen_foreing_key('venda')

			sql 	= "INSERT INTO item_produto_venda (preco_unitario, quantidade, id_produto, id_venda) VALUES (%s, %s, %s, %s)"
			values 	= (preco_unitario, quantidade, id_produto, id_venda)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_produto_venda (preco_unitario, quantidade, id_produto, id_venda) VALUES " + str(values) + ";\n")

			#----------------------------ITEM-COMBO-VENDA-------------------------------

			preco_unitario	= gen_value(integer=2)
			quantidade		= gen_number(size=1)
			id_combo 		= gen_foreing_key('combo')
			id_venda		= gen_foreing_key('venda')

			sql 	= "INSERT INTO item_combo_venda (preco_unitario, quantidade, id_combo, id_venda) VALUES (%s, %s, %s, %s)"
			values 	= (preco_unitario, quantidade, id_combo, id_venda)

			if(try_insert(sql, values)):
				file.write("INSERT INTO lanchonete.item_combo_venda (preco_unitario, quantidade, id_combo, id_venda) VALUES " + str(values) + ";\n")


	sql = "SET FOREIGN_KEY_CHECKS=1"
	cursor.execute(sql)
	conn.commit()

	file.write(sql + ";\n")

'''
sql = "SELECT * FROM filial"

cursor.execute(sql)

result = cursor.fetchall()

for i in result:
	print(i)
'''