# !/usr/bin/env python
# -*- coding : utf8 -*-

# Author: GHARBI Houssem

import sys, os

"""
execution: python CreateInstance.py -in1 Parseur/fichier1.txt -in2 Parseur/fichier2.txt

genere 4 fichiers:
- Instances_enzyme.sql
- Instances_swissprot.sql
- Instances_prosite.sql
- Instances_publication.sql

"""

try:
	File_IN1 = sys.argv[sys.argv.index("-in1")+1]
except:    
	print ("ERROR: please, enter the name of the first input file")
	sys.exit()

try:
	File_IN2 = sys.argv[sys.argv.index("-in2")+1]
except:    
	print ("ERROR: please, enter the name of the input second file")
	sys.exit()

f_in1 = open(File_IN1, 'r')
f_lines1 = f_in1.read().splitlines()

f_in2 = open(File_IN2, 'r')
f_lines2 = f_in2.read().splitlines()

DataBase = "DataBase"
os.system("mkdir -p %s"%(DataBase))
f_enzyme = open("%s/Instances_enzyme.sql"%(DataBase),"w+")
f_S = open("%s/Instances_swissprot.sql"%(DataBase),"w+")
f_P = open("%s/Instances_prosite.sql"%(DataBase),"w+")
f_Pub = open("%s/Instances_publication.sql"%(DataBase),"w+")



# lecture du fichier1.txt
Num_ligne=0
for line in f_lines1:
	
	if line == 'EC':
		EC = f_lines1[Num_ligne+1]
	
	elif line == 'S_NAME':
		S_NAME = f_lines1[Num_ligne+1] 
		S_NAME = S_NAME.replace("\'","")
		S_NAME = S_NAME.split('.')[0]		
		if S_NAME == '':
			S_NAME = 'NULL'
	elif line == 'O_NAME':
		O_NAME= f_lines1[Num_ligne+1]
		O_NAME = O_NAME.replace("\'","")
		O_NAME = O_NAME.split('.')[0]
		if O_NAME == '':
			O_NAME = 'NULL'
	
	elif line == 'COFACTORS':
		COFACTORS= f_lines1[Num_ligne+1]
		COFACTORS = COFACTORS.replace("\'","")
		if COFACTORS == '':
			COFACTORS = 'NULL'
	elif line == 'COMMENTS':
		COMMENTS= f_lines1[Num_ligne+1]
		COMMENTS= COMMENTS.replace("\'","")
		if COMMENTS == '':
			COMMENTS = 'NULL'
	
	elif line == 'ACTIVITY':
		ACTIVITY= f_lines1[Num_ligne+1]
		ACTIVITY = ACTIVITY.replace("\'","")
		if ACTIVITY == '':
			ACTIVITY = 'NULL'
	
	elif line == 'SWISSPROT':
		SWISSPROT= f_lines1[Num_ligne+1].split(';')
		
	elif line == 'PROSITE':
		PROSITE= f_lines1[Num_ligne+1].split(';')
	
	if line == 	'/SWISSPROT':
		f_enzyme.write("INSERT INTO enzyme VALUES ( '"+EC+"','"+S_NAME+"','"+O_NAME+"','"+COFACTORS+"','"+COMMENTS+"','"+ACTIVITY+"');\n")
		
		if SWISSPROT:
			for cle in SWISSPROT[:5]:
				cle = cle.split(',')[0]
				if cle != '':
					f_S.write("INSERT INTO swissprot VALUES ( '"+cle+"','"+EC+"');\n")
		if PROSITE:
			for cle in PROSITE:
				if cle != '':
					f_P.write("INSERT INTO prosite VALUES ( '"+cle+"','"+EC+"');\n")
	Num_ligne += 1

f_in1.close()



# lecture du fichier2.txt
Num_ligne=0
for line in f_lines2:
	if line == 'ec':
		ec = f_lines2[Num_ligne+1]
	
	if line == 'authors':
		AUTEURS = f_lines2[Num_ligne+1]
		AUTEURS = AUTEURS.replace("\'","")
	
	if line == 'title':
		TITLE = f_lines2[Num_ligne+1]
		TITLE = TITLE.replace("\'","")		
	
	if line == 'year':
		YEAR = f_lines2[Num_ligne+1]
		YEAR = YEAR.replace("\'","")
		f_Pub.write("INSERT INTO publication VALUES ( '"+TITLE+"','"+YEAR+"','"+ec+"','"+AUTEURS+"');\n")
	
	
	Num_ligne += 1
	
f_in2.close()
