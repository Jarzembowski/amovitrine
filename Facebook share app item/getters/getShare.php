<?php
include_once('../safe/conn.php');
header('Content-type: application/json; charset=utf-8');

try {
    $data = array();
    $pdo = pdo();
    $ItemId = $_GET['ItemId'];
    $Query = "SELECT item.ItemId,ItemCodigo,ItemSituacao,ItemCategoria,ItemValor1,ItemValor2,ItemTipo,ItemNome,ItemDescricao,ItemAvatar,ItemPendencia, TipoNome, CategoriaNome,LojaPagamentos, LojaEndereco, loja.LojaId, loja.LojaNome, loja.LojaCapa, loja.LojaImagem, loja.LojaPagamentos, loja.LojaStatus as StatusLoja ,LojaTelefone1,LojaTelefone2   FROM `item` LEFT JOIN tipo ON tipo.TipoId = item.ItemTipo LEFT JOIN categoria ON item.ItemCategoria = categoria.CategoriaId LEFT JOIN itemloja ON itemloja.ItemId = item.ItemId LEFT JOIN loja ON itemloja.LojaId = loja.LojaId LEFT JOIN itemtempo ON itemtempo.ItemId = item.ItemId WHERE item.ItemId=".$ItemId." GROUP BY loja.LojaId";

    $go = $pdo->prepare($Query);
    $go->execute();

    $results = $go->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        array_push($data,$row);
    }


    echo json_encode(array("result" => 1, "content" => $data));

}catch (Exception $e){
    echo json_encode(array("result" => 0, "exception" => $e));
}
?>