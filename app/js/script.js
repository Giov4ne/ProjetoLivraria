const search = document.querySelector('#pesquisa');
search.addEventListener('submit', goToCatalogo);

const searchBtn = document.querySelector('#lupa');
searchBtn.addEventListener('click', ()=>{
    goToCatalogo();
    search.submit();
});

function goToCatalogo(){ //redireciona a tela para o catalogo de produtos
    location.href='#produtos';
}

const iconeCarrinho = document.querySelector('#carrinho-icon');
iconeCarrinho.addEventListener('click', abrirFecharMenu);
const menuCarrinho = document.querySelector('#carrinho');
const fechaCarrinhoBtn = document.querySelector('#fecha-carrinho');
fechaCarrinhoBtn.addEventListener('click', abrirFecharMenu);
let menuAberto = menuCarrinho.classList.contains('carrinho-on');

function abrirFecharMenu(){
    if(menuAberto){
       menuCarrinho.classList.remove('carrinho-on'); 
       menuAberto = false;
    } else{
        menuCarrinho.classList.add('carrinho-on');
        menuAberto = true;
    }
}

//seção de filtragem de produtos
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

const comprarBtns = document.querySelectorAll('.comprar-btn');
comprarBtns.forEach(btn => btn.addEventListener('click', ()=>comprarLivro(btn.dataset.c)));

function comprarLivro(codLivro){
    const cod = codLivro.split('cod')[1];
    const qtd = document.querySelector(`input.qtd-livros[data-c="cod${cod}"]`).value;
    location.href=`?action=buy&cod=${cod}&qtd=${qtd}`;
}

const voltarBtn = document.querySelector('#voltar');
voltarBtn.addEventListener('click', ()=>window.scroll({top:0,behavior:'smooth'})); //redireciona a tela para o topo da página