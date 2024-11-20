<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// página principal (controller home)

$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('sobrenos', 'Home::sobrenos');
$routes->get('contato', 'Home::contato');
$routes->post('contatoEnviaEmail', 'Home::contatoEnviaEmail');
$routes->get('login', 'Home::login');
$routes->get('trocarSenha', 'Home::trocarSenha'); 
$routes->post('trocarSenha', 'Home::trocarSenha'); 
$routes->get('criarNovaConta', 'Home::criarNovaConta');
$routes->post('addVeiculoCarrinho', 'Home::addVeiculoCarrinho');
$routes->post('atualizaVeiculoCarrinho', 'Home::atualizaVeiculoCarrinho');
$routes->post('atualizaFrete', 'Home::atualizaFrete');
$routes->post('atualizaCarrinho', 'Home::atualizaCarrinho');
$routes->post('gravarNovaConta', 'Home::gravarNovaConta');
$routes->get('carrinhoCompras', 'Home::carrinhoCompras');
$routes->get('carrinhoPagamento', 'Home::carrinhoPagamento');
$routes->get('carrinhoConfirmacao', 'Home::carrinhoConfirmacao');
$routes->get('veiculodetalhe/(:num)', 'Home::veiculoDetalhe/$1');
$routes->post('alterarSenhaProcess', 'login::alterarSenhaProcess'); 
$routes->get('admin', 'Home::admin');
$routes->get('homeMarca/(:num)', 'Home::homeMarca/$1');

// 
$routes->group('Login', function ($routes) {
    $routes->post('signIn', 'Login::signIn');
    $routes->get('signOut', 'Login::signOut');    

});

// sistema
$routes->group('Sistema', function ($routes) {
    $routes->get('home', 'Sistema::home');
    $routes->get('trocarsenha','Sistema::trocarSenha');
});
// Crud Pessoa
$routes->group('Pessoa', function ($routes) {
    $routes->get('form/(:segment)/(:num)', 'Pessoa::form/$1/$2');
    $routes->post('store', 'Pessoa::store');
    $routes->get('getCidade/(:num)', 'Pessoa::getCidade/$1');
});
// Crud PessoaEndereco
$routes->group('PessoaEndereco', function ($routes) {
    $routes->get('/', 'PessoaEndereco::index');
    $routes->get('lista', 'PessoaEndereco::index');
    $routes->get('form/(:segment)/(:num)', 'PessoaEndereco::form/$1/$2');
    $routes->post('store', 'PessoaEndereco::store');
    $routes->post('delete', 'PessoaEndereco::delete');
});

$routes->group('Vendedor', function ($routes) {
    $routes->get('/', 'Vendedor::index');
    $routes->get('lista', 'Vendedor::index');
    $routes->get('form/(:segment)/(:num)', 'Vendedor::form/$1/$2');
    $routes->post('store', 'Vendedor::store');
    $routes->post('delete', 'Vendedor::delete');
});
// Crud Pedido
$routes->group('Pedido', function ($routes) {
    $routes->get('/', 'Pedido::index');
    $routes->get('lista', 'Pedido::index');
    $routes->get('viewPedido/(:num)', 'Pedido::viewPedido/$1');
});

// Crud UF
$routes->group('Uf', function ($routes) {
    $routes->get('/', 'Uf::index');
    $routes->get('lista', 'Uf::index');
    $routes->get('form/(:segment)/(:num)', 'Uf::form/$1/$2');
    $routes->post('store', 'Uf::store');
    $routes->post('delete', 'Uf::delete');
});
// Crud Cidade
$routes->group('Cidade', function ($routes) {
    $routes->get('/', 'Cidade::index');
    $routes->get('lista', 'Cidade::index');
    $routes->get('form/(:segment)/(:num)', 'Cidade::form/$1/$2');
    $routes->post('store', 'Cidade::store');
    $routes->post('delete', 'Cidade::delete');
});


// Crud Marca
$routes->group('Marca', function ($routes) {
    $routes->get('/', 'Marca::index');
    $routes->get('lista', 'Marca::index');
    $routes->get('form/(:segment)/(:num)', 'Marca::form/$1/$2');
    $routes->post('store', 'Marca::store');
    $routes->post('delete', 'Marca::delete');

});
// Crud Pessoa
$routes->group('Pessoa', function ($routes) {
    $routes->get('form/(:segment)/(:num)', 'Pessoa::form/$1/$2');
    $routes->post('store', 'Pessoa::store');
    $routes->get('getCidade/(:num)', 'Pessoa::getCidade/$1');
});

// Crud Pedido
$routes->group('Pedido', function ($routes) {
    $routes->get('/', 'Pedido::index');
    $routes->get('lista', 'Pedido::index');
    $routes->get('viewPedido/(:num)', 'Pedido::viewPedido/$1');
});


// Crud Veiculo
$routes->group('Veiculo', function ($routes) {
    $routes->get('/', 'Veiculo::index');
    $routes->get('lista', 'Veiculo::index');
    $routes->get('form/(:segment)/(:num)', 'Veiculo::form/$1/$2');
    $routes->post('store', 'Veiculo::store');
    $routes->get('veiculo/detalhe/(:num)', 'Veiculo::detalhe/$1');
    $routes->post('delete', 'Veiculo::delete');
    $routes->get('excluirImagem/(:num)/(:segment)/(:segment)', 'Veiculo::excluirImagem/$1/$2/$3');
});
//Crud Usuario
$routes->group('Usuario', function ($routes) {
    $routes->get('/', 'Usuario::index');
    $routes->get('lista', 'Usuario::index');
    $routes->get('form/(:segment)/(:num)', 'Usuario::form/$1/$2');
    $routes->post('store', 'Usuario::store');
    $routes->post('delete', 'Usuario::delete');
    $routes->get('viewUsuario/(:num)', 'Usuario::viewUsuario/$1');

});

