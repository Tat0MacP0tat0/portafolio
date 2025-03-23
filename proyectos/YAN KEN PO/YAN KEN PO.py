#Importamos la libreria random con un alias "rdn"
import random as rdn
#Creamos las opciones
opciones=["piedra","papel","tijera"]
#Imprimimos las opciones en pantalla
print(f'''=====YA KEN PO=====
0. {opciones[0]}
1. {opciones[1]}
2. {opciones[2]}''')
#El jugador ingresa su opcion
player=int(input("ingrese un numero:"))
#el bot elije su opcion
bot=rdn.randint(0,2)
#iniciamos las variables de texto que imprimiremos en los resultados
estado=""
simbolo=""
#Optimizamos el uso de las condicionales con conceptos apredidos en matematica discreta(modulos)
if player==bot:
    estado="EMPATE :|"
    simbolo="="

elif (player-bot)%3==1:
    estado="GANASTE :)"
    simbolo=">"
else:
    estado="PERDISTE :("
    simbolo="<"
#Imprimimos resultados
print(f'''************RESULDATOS************
{estado}
player:{player} {simbolo} bot:{bot}
player:{opciones[player]} {simbolo} bot:{opciones[bot]}''')