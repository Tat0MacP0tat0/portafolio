let player=null;
let bot=null;
let estado=null;
let simbolo=null;
const boton0=document.getElementById("boton0");
const boton1=document.getElementById("boton1");
const boton2=document.getElementById("boton2");
const botonJugar=document.getElementById("botonJugar");
const respuesta=document.getElementById("respuesta");
boton0.addEventListener("click",()=>{player=0});
boton1.addEventListener("click",()=>{player=1});
boton2.addEventListener("click",()=>{player=2});
function jugar()
{
    bot=Math.floor(Math.random()*3)
    if (player==bot)
        {
            estado="EMPATE :|";
            simbolo="=";
        }
    else if ((player-bot+3)%3==1)
        {
            estado="GANASTE :)";
            simbolo=">";
        }   
    else
    {
        estado="PERDISTE :(";
        simbolo="<";
    }
    let opciones=["piedra","papel","tijera"];
    respuesta.value=estado+"\n"+ "player: "+opciones[player]+" "+simbolo+" "+opciones[bot]+" :bot";
}


