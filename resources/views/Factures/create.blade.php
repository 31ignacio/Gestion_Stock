@extends('layouts.master2')

@section('content')
    <div class="container">
        <div class="callout callout-info">
                <div id=="msg24"></div>
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" id="date" class="form-control" style="width: 100%;border-radius:10px;">
                    </div><!-- /input-group -->
                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label>Clients</label>
                        <select class="form-control select2" id="client" style="width: 100%;border-radius:10px;">
                            <option></option>

                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                            @endforeach

                        </select>
                    </div><!-- /input-group -->
                </div>


                <div class="col-md-4">

                    <div class="form-group">
                        <label>Mode de paiement</label>
                        <select class="form-control" id="mode" style="width: 100%;border-radius:10px;">
                            <option></option>

                            @foreach ($modes as $mode)
                                <option value="{{ $mode->id }}">{{ $mode->modePaiement }}</option>
                            @endforeach
                        </select>
                    </div><!-- /input-group -->
                </div>


            </div>


        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    {{-- <h4>
          <i class="fas fa-globe"></i> AdminLTE, Inc.
          <small class="float-right">Date: 2/10/2014</small>
        </h4> --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <form id="monFormulaire">
                <div id="msg25"></div>
                <div class="row">
                    <div class="col-md-3">


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn-sm btn-secondary">Produit</button>
                            </div>

                            <select class="form-control select2" id="produit" style="width: 100%;border-radius:10px;">
                                <option></option>
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit->libelle }}" data-stock="{{ $produit->stock_actuel }}">
                                        {{ $produit->libelle }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div id="message" style="color: red;"></div>

                        <!-- /input-group -->
                    </div><br>
                    <div class="col-md-1"></div>

                    <div class="col-md-3">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn-sm btn-secondary">TVA(%)</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" id='tva'>
                        </div><br>
                        <!-- /input-group -->
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-3">

                        <!-- /input-group -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn-sm btn-secondary">Quantité</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" id='quantite'>


                        </div>
                    </div>
                    <div class="col-md-1"></div>


                    <div class="col-md-3">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn-sm btn-secondary">Prix</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" id='prix'>
                        </div>
                        <!-- /input-group -->
                    </div>
                    <div class="col-md-5">

                        <input type="button" class="btn btn-primary" value="Ajouter" onclick="ajouterAuTableau()">

                        <input type="button" class="btn btn-danger" value="Annuler" onclick="supprimerDerniereLigne()">
                        {{-- <a class="btn btn-danger" href="#" onclick="supprimerDerniereLigne()">Supprimer</a> --}}

                    </div>

                </div>
                <!-- /.row -->
            </form>
            <!-- Table row -->
            <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="monTableau">
                        <thead>
                            <tr>
                                <th>Quantité</th>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody id="monTableauBody">
                            <!-- Les lignes de tableau seront ajoutées ici -->
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">

                </div>
                <!-- /.col -->
                <div class="col-6">
                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                    <div class="table-responsive">
                        <table class="table">

                            <tr>
                                <th style="width:50%">Total HT:</th>
                                <td id="totalHT">0</td>
                            </tr>
                            <tr>
                                <th>Total TVA</th>
                                <td id="totalTVA">0</td>
                            </tr>
                            <tr>
                                <th>Total TTC</th>
                                <td id="totalTTC" class="right badge-md badge-success">0</td>
                            </tr>
                            <tr>
                                <th>Montant payé</th>
                                <td><input type="text" class="form-control" id="montant"></td>

                            </tr>
                        </table>

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    {{-- <button type="button" class="btn btn-success" onclick="enregistrerDonnees()">Enregistrer</button> --}}

                    <button type="button" class="btn btn-success float-right"
                        style="margin-right: 5px;"onclick="enregistrerDonnees()">
                        <i class="fas fa-download"></i> Valider
                    </button>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
        <div id="msg200"></div>

    </div>

    {{-- Ajouter produit dans le tableau --}}
    <script>
        function ajouterAuTableau() {
            // Récupérer les valeurs du formulaire
            var quantite = document.getElementById("quantite").value;
            var produit = document.getElementById("produit").value;
            var prix = document.getElementById("prix").value;

            if (quantite.trim() === "" || produit.trim() === "" || prix.trim() === "") {
                    // Ajoutez ici le code pour afficher un message d'erreur ou faites une action appropriée
                    $('#msg25').html(` <p  class="text-danger">
                        <strong>Veuillez remplir tous les champs (quantité, produit, prix).</strong>
                                    </p>`);
                        // Masquer le message après 3 secondes
                        setTimeout(function() {
                            $('#msg25').html('');
                        }, 5000); // 3000 millisecondes équivalent à 3 secondes
                }else{

            // Calculer le total en multipliant la quantité par le prix
            var total = quantite * prix;

            // Sélectionner le tableau
            var tableauBody = document.getElementById("monTableauBody");

            // Créer une nouvelle ligne dans le tableau
            var newRow = tableauBody.insertRow(tableauBody.rows.length);

            // Insérer les cellules avec les valeurs du formulaire
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            cell1.innerHTML = quantite;
            cell2.innerHTML = produit;
            cell3.innerHTML = prix;
            cell4.innerHTML = total.toFixed(); // Afficher le total avec deux décimales

            // Mettre à jour le total HT
            mettreAJourTotalHT();

            // Réinitialiser le formulaire
            //document.getElementById("monFormulaire").reset();

            // Vider les champs sauf TVA
            document.getElementById("quantite").value = "";
            document.getElementById("produit").value = "";
            document.getElementById("prix").value = "";

            // Restaurer la valeur de TVA
            //document.getElementById("tva").value = tva;
        }}

        function mettreAJourTotalHT() {
            // Sélectionner le tableau
            var tva = document.getElementById("tva").value;
            var tableauBody = document.getElementById("monTableauBody");
            var totalHT = 0;

            for (var i = 0; i < tableauBody.rows.length; i++) {
                var cell = tableauBody.rows[i].cells[3]; // 4ème cellule contenant le total
                totalHT += parseFloat(cell.innerHTML);
            }
            totalTVA = (totalHT * tva) / 100
            totalTTC = (totalHT + totalTVA)
            // Afficher le total HT mis à jour dans la cellule correspondante
            document.getElementById("totalHT").innerHTML = totalHT.toFixed(); // Afficher le total avec deux décimales
            document.getElementById("totalTVA").innerHTML = totalTVA.toFixed(); // Afficher le total avec deux décimales
            document.getElementById("totalTTC").innerHTML = totalTTC.toFixed(); // Afficher le total avec deux décimales

        }


        function supprimerDerniereLigne() {
            // Sélectionner le tableau
            var tableauBody = document.getElementById("monTableauBody");

            // Vérifier s'il y a des lignes dans le tableau
            if (tableauBody.rows.length > 0) {
                // Supprimer la dernière ligne
                tableauBody.deleteRow(tableauBody.rows.length - 1);
                // Mettre à jour le total HT
                mettreAJourTotalHT();
            }
        }
    </script>


    <script>
        function enregistrerDonnees(donnees) {
            // Récupérer toutes les lignes du tableau
            var tableauBody = document.getElementById("monTableauBody");
            var date = document.getElementById("date").value;
            var client = document.getElementById("client").value;
            var mode = document.getElementById("mode").value;
            var totalHT = document.getElementById("totalHT").textContent;
            var totalTVA = document.getElementById("totalTVA").textContent;
            var totalTTC = document.getElementById("totalTTC").textContent;
            var montant = document.getElementById("montant").value;
            //alert(montant)


            var donnees = [];

            for (var i = 0; i < tableauBody.rows.length; i++) {
                var ligne = tableauBody.rows[i];
                var quantite = ligne.cells[0].textContent;
                var produit = ligne.cells[1].textContent;
                var prix = ligne.cells[2].textContent;
                var total = ligne.cells[3].textContent;
                //alert(totalHT)
                    donnees.push({
                        quantite: quantite,
                        produit: produit,
                        prix: prix,
                        total: total
                    });


            }

            // Envoyer les données au serveur via une requête AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('facture.store') }}", // L'URL de votre route Laravel
                data: {
                    _token: '{{ csrf_token() }}',
                    donnees: JSON.stringify(donnees),
                    client,
                    date,
                    mode,
                    totalTTC,
                    totalHT,
                    totalTVA,
                    montant
                },
                success: function(response) {
                    // Gérer la réponse du serveur ici (par exemple, afficher un message de confirmation)
                    if (parseInt(response) == 200 || parseInt(response) == 500) {

                        parseInt(response) == 500 ? ($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.

                            </div>`)) : ($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Facture établie avec succès </strong>

                            </div>`));
                    }

                    var url = "{{ route('facture.index') }}"
                    if (response == 200) {
                        setTimeout(function() {
                            window.location = url
                        }, 1000)
                    } else {
                        $("#msg200").html(response);

                    }
                },

            });
        }
    </script>

    {{-- verifier le stock --}}
    <script>
        var quantiteInput = document.getElementById("quantite");
        var produitSelect = document.getElementById("produit");
        var message = document.getElementById("message");
        var previousValue = quantiteInput.value;
        var previousSelectedIndex = produitSelect.selectedIndex;

        quantiteInput.addEventListener("input", function() {
            validateQuantite();
        });

        produitSelect.addEventListener("change", function() {
            validateQuantite();
        });

        function validateQuantite() {
            var selectedOption = produitSelect.options[produitSelect.selectedIndex];
            var stock = parseFloat(selectedOption.getAttribute("data-stock"));
            var quantite = parseFloat(quantiteInput.value);

            if (isNaN(quantite) || isNaN(stock) || quantite <= stock) {
                message.textContent = "";
                quantiteInput.style.borderColor = "";
            } else {
                message.textContent = "Stock insuffisant!";
                quantiteInput.style.borderColor = "red";

                // Efface le champ de quantité après 3 secondes
                setTimeout(function() {
                    quantiteInput.value = "";
                }, 3000);
            }

            // Vérifiez si l'utilisateur a changé de produit
            if (produitSelect.selectedIndex !== previousSelectedIndex) {
                quantiteInput.value = "";
                previousSelectedIndex = produitSelect.selectedIndex;
            }

            // Vérifiez si la quantité a été modifiée manuellement
            if (quantiteInput.value !== previousValue) {
                previousSelectedIndex = produitSelect.selectedIndex;
            }
        }


        // Vous pouvez appeler validateQuantite() au chargement de la page pour vérifier la quantité initiale
        validateQuantite();
    </script>
@endsection
