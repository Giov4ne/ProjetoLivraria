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

const voltarBtn = document.querySelector('#voltar');
voltarBtn.addEventListener('click', ()=>window.scroll({top:0,behavior:'smooth'}));