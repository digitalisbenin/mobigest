$(document).ready(function() {
    console.log("Script chargé !");
    $("#imei").on("input", function() {
        console.log("IMEI saisi :", $(this).val());
        var imei = $(this).val();

        if (imei === "" || imei.length <= 3) {
            $("#modele, #couleur, #capacite, #etat, #IdEntre").val("");
        } else if (imei.length > 3) {
            $.ajax({
                url: "{{ route('get.article.details') }}",
                type: "GET",
                data: { imei: imei },
                success: function(response) {
                    console.log("Réponse du serveur :", response);

                    if (response.success) {
                        $("#modele").val(response.data.modele);
                        $("#couleur").val(response.data.couleur);
                        $("#capacite").val(response.data.capacite);
                        $("#etat").val(response.data.etat);
                        $("#IdEntre").val(response.data.IdEntre);
                        $("#prixvente").val(response.data.prixvente);
                        $("#Id_Article").val(response.data.Id_Article);
                    } else {
                        $("#modele, #couleur, #capacite, #etat").val("");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Erreur AJAX :", error);
                }
            });
        }
    });
});
