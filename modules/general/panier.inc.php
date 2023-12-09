<?php

//////////////////////////////////////////////// creation panier
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['idprod'] = array();
      $_SESSION['panier']['qt'] = array();
      $_SESSION['panier']['prix'] = array();
      $_SESSION['panier']['pachat'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

//////////////////////////////////////////////// Ajout produit
function ajouterArticle($libelleProduit,$qteProduit,$prixProduit,$pachat,$maxqt){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['idprod']);

      if ($positionProduit !== false)
      {
      	if (($_SESSION['panier']['qt'][$positionProduit] + $qteProduit)<$maxqt)
      	{
      		$_SESSION['panier']['qt'][$positionProduit] += $qteProduit;
      	}
      	else { $_SESSION['panier']['qt'][$positionProduit] = $maxqt; }
         
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['idprod'],$libelleProduit);
         array_push( $_SESSION['panier']['qt'],$qteProduit);
         array_push( $_SESSION['panier']['prix'],$prixProduit);
         array_push( $_SESSION['panier']['pachat'],$pachat);
      }
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
//////////////////////////////////////////////// supprimer produit
function supprimerArticle($libelleProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Nous allons passer par un panier temporaire
      $tmp=array();
      $tmp['idprod'] = array();
      $tmp['qt'] = array();
      $tmp['prix'] = array();
      $tmp['pachat'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['idprod']); $i++)
      {
         if ($_SESSION['panier']['idprod'][$i] != $libelleProduit)
         {
         	array_push( $tmp['idprod'],$_SESSION['panier']['idprod'][$i]);
            array_push( $tmp['qt'],$_SESSION['panier']['qt'][$i]);
            array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            array_push( $tmp['pachat'],$_SESSION['panier']['pachat'][$i]);
         }

      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      //On efface notre panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


//////////////////////////////////////////////// MAJ
function modifierQTeArticle($libelleProduit,$qteProduit,$pvente){
   //Si le panier éxiste
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qteProduit > 0)
      {
         //Recharche du produit dans le panier
         $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['idprod']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['qt'][$positionProduit] = $qteProduit ;
            $_SESSION['panier']['pvente'][$positionProduit] = $pvente;
         }
      }
      else
      supprimerArticle($libelleProduit);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
////////////////////////////////////////////////

function isVerrouille(){
	if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
		return true;
	else
		return false;
}

function compterArticles()
{
	if (isset($_SESSION['panier']))
		return count($_SESSION['panier']['libelleProduit']);
	else
		return 0;

}

function supprimePanier(){
	unset($_SESSION['panier']);
}

?>