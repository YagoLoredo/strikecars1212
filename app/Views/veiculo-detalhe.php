<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section>
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-center">
                <h1 style="color: #384aeb;">Detalhes do Veiculo</h1>
            </div>
        </div>
    </div>
</section>

<div class="product_image_area">
    <div class="container ">
        <div class="row s_product_inner">

            <div class="col-lg-6 detalhe">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner ">
                        <?php
                            $active = true;
                            foreach ($imagem as $value) {
                                ?>                            
                                <div class="carousel-item <?= ($active ? 'active': '') ?>">
                                    <img src="<?= base_url("uploads/veiculo/" . $value['nomeArquivo']) ?>" class="d-block w-100" alt="...">
                                </div>
                                <?php
                                $active = false;
                            }
                        ?>
                    </div>
                    <button class="carousel-control-prev" style="border-bottom: 0px; border:none!important;" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" style="border-bottom: 0px; border:none!important;" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1 carros">
                <div class="s_product_text preco">
                    <h3><?= $this->data['modelo'] ?></h3>
                    <h2>R$ <?= formatValor($this->data['precoVenda']) ?></h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Categoria</span> : Veiculos</a></li>
                    </ul>
                    <p>
                        <?= $this->data['detalhamento'] ?> 
                    </p>
                    <div class="product_count">
                        <label for="qty">Quantidade:</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                        class="input-text qty" style="height: 40px !important">
                                    <button
                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                        class="increase items-count" type="button"><i
                                            class="ti ti-angle-up"></i></button>
                                    <button
                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;"
                                        class="reduced items-count" type="button"><i
                                            class="ti ti-angle-down"></i></button>
                        
                    </div>
                    <a class="button primary-btn compra" onclick="addVeiculoCarrinho(<?= $this->data['id'] ?>)">Comprar</a>
                    <div class="card_area d-flex align-items-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product_description_area carros">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Descrição</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Especificação</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Comentários</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p><?= $this->data['detalhamento'] ?></p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>modelo</h5>
                                </td>
                                <td>
                                    <h5><?= $this->data['modelo'] ?>  </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Ano de Fabricao</h5>
                                </td>
                                <td>
                                    <h5><?= $this->data['anoFabricacao'] ?>  </h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>detalhamento</h5>
                                </td>
                                <td>
                                    <h5><?= $this->data['detalhamento'] ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>preco de Venda</h5>
                                </td>
                                <td>
                                    <h5><?= $this->data['precoVenda'] ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/usuario/usuario-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Elon Musk</h4>
                                        <h5>20 Outubro, 2024 às 22:12</h5>
                                    </div>
                                </div>
                                <p>
                                Esse carro parece um carro sólido para o segmento que atende. Mas imagine 
                                o mesmo veículo com uma bateria de longo alcance, aceleração de 0-100 km/h 
                                em menos de 3 segundos e recarga gratuita em superchargers. 😉
                            </p>
                            </div>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/usuario/usuario-2.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4>Ana Maria Braga</h4>
                                        <h5>21 setembro, 2024 às 14:45</h5>
                                    </div>
                                </div>
                                <p>
                                Olha, esse carro é aquele carro que tem estilo e cabe no bolso, né? Um sedã bonito, 
                                espaçoso e ótimo pra família. Dá pra ir pro mercado, levar as crianças pra escola 
                                e ainda viajar no fim de semana com conforto. É o tipo de carro que você compra e não 
                                se arrepende... e eu adoro quando algo assim acontece, né, Louro? 🚗✨
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Enviar comentário</h4>
                            <form class="row contact_form" action="contact_process.php" method="post" id="contactForm"
                                novalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="mensagem" id="mensagem" rows="4"
                                            placeholder="Mensagem"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</section>

<script src="<?= base_url("assets/js/carrinhocompras.js") ?>" type="text/Javascript"></script>

<?= $this->endSection() ?>