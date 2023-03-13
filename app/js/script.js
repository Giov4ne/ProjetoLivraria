const search = document.querySelector('#pesquisa');
search.addEventListener('submit', goToCatalogo);

const searchBtn = document.querySelector('#lupa');
searchBtn.addEventListener('click', ()=>{
    goToCatalogo();
    search.submit();
});

function goToCatalogo(){
    location.href='#produtos';
}

const generos = document.querySelectorAll('.genero');
const valorMin = document.querySelector('#valor-min');
const valorMax = document.querySelector('#valor-max');
const filtrarBtn = document.querySelector('#filtrar-btn');
filtrarBtn.addEventListener('click', ()=>{
    const generosChecked = [];
    generos.forEach(genero => (genero.checked) ? generosChecked.push(genero.name) : '');
    if(valorMin.value && valorMax.value && valorMax.value >= valorMin.value){
        location.href=`./home.php?action=filter&generos=${generosChecked}&min=${valorMin.value}&max=${valorMax.value}#produtos`;
    } else{
        location.href=`./home.php?action=filter&generos=${generosChecked}#produtos`;
    }
});

const voltarBtn = document.querySelector('#voltar');
voltarBtn.addEventListener('click', ()=>window.scroll({top:0,behavior:'smooth'}));