let a,b,c,d;

let colSelect1=document.getElementById("color-selecionado1");
colSelect1.value=""
colSelect1.addEventListener("change", function(){
    let claseAntigua1=colSelect1.classList.item(0);
    colSelect1.classList.remove(claseAntigua1);
    colSelect1.classList.add("color-"+ colSelect1.value);

    switch(colSelect1.value)
    {
        case "negro":
            a=0;
            break;
        case "cafe":
            a=1;
            break;
        case "rojo":
            a=2;
            break;
        case "naranja":
            a=3;
            break;
        case "amarillo":
            a=4;
            break;
        case "verde":
            a=5;
            break;
        case "azul":
            a=6;
            break;
        case "violeta":
            a=7;
            break;
        case "gris":
            a=8;
            break;
        case "blanco":
            a=9;
            break;
        default:
            a="";
            break;
    }
});

let colSelect2=document.getElementById("color-selecionado2");
colSelect2.value=""
colSelect2.addEventListener("change", function(){
    let claseAntigua2=colSelect2.classList.item(0);
    colSelect2.classList.remove(claseAntigua2);
    colSelect2.classList.add("color-"+ colSelect2.value);
    switch(colSelect2.value)
    {
        case "negro":
            b=0;
            break;
        case "cafe":
            b=1;
            break;
        case "rojo":
            b=2;
            break;
        case "naranja":
            b=3;
            break;
        case "amarillo":
            b=4;
            break;
        case "verde":
            b=5;
            break;
        case "azul":
            b=6;
            break;
        case "violeta":
            b=7;
            break;
        case "gris":
            b=8;
            break;
        case "blanco":
            b=9;
            break;
        default:
            b="";
            break;
    }

});

let colSelect3=document.getElementById("color-selecionado3");
colSelect3.value=""
colSelect3.addEventListener("change", function(){
    let claseAntigua3=colSelect3.classList.item(0);
    colSelect3.classList.remove(claseAntigua3);
    colSelect3.classList.add("color-"+ colSelect3.value);
    switch(colSelect3.value)
    {
        case "negro":
            c=1;
            break;
        case "cafe":
            c=10;
            break;
        case "rojo":
            c=100;
            break;
        case "naranja":
            c=1000;
            break;
        case "amarillo":
            c=10000;
            break;
        case "verde":
            c=100000;
            break;
        case "azul":
            c=1000000;
            break;
        case "violeta":
            c=10000000;
            break;
        case "gris":
            c=100000000;
            break;
        case "blanco":
            c=1000000000;
            break;
        default:
            c="";
            break;
    }

});


let colSelect4=document.getElementById("color-selecionado4");
colSelect4.value=""
colSelect4.addEventListener("change", function(){
    let claseAntigua4=colSelect4.classList.item(0);
    colSelect4.classList.remove(claseAntigua4);
    colSelect4.classList.add("color-"+ colSelect4.value);
    switch(colSelect4.value)
    {
        case "rojo":
            d="2%";
            break;
        case "dorado":
            d="5%";
            break;
        case "plata":
            d="10%";
            break;
        default:
            d="";
            break;
    }

});

let resistencia=document.getElementById("resistencia");

function calcular()
{
    if(a==null || b==null || c==null || d==null)
    {
        resistencia.value="Complete los campos faltantes"
    }
    else
    {
        resistencia.value=`${(a*10+b)*c}Ω+/-${d}`;
    }
}
