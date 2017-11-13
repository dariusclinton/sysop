$(function () {

//    alert('hello');

    /**
     * Confirmer la suppression d'un avis
     */
    $('.delete_confirm').click(function () {
        if (confirm('Etes vous certain de vouloir supprimer cette entrée ?')) {

        } else {
            return false;
        }
    });

});
