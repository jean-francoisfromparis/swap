

// Chargement des photos et preview
document.addEventListener('DOMContentLoaded', function(){
    if(document.getElementById('photo1')){
        document.getElementById('file1').addEventListener('change', function(event){
            let fichier = event.target.files[0];
            console.log(fichier);
            let ext = ['image/jpeg', 'image/png']
            if(ext.includes(fichier.type)){
            let reader = new FileReader();
            reader.readAsDataURL(fichier);
            reader.onload = (e) => {
                document.querySelector('#photo1 img').setAttribute('src',e.target.result);
                //pour les annonces

                if(document.getElementById('nom_original')){
                    document.getElementById('nom_original').setAttribute('value', fichier.name);
                    document.getElementById('data_img').setAttribute('value', e.target.result);
                }
            }
        }
        });
    }
    if(document.querySelectorAll('a.confirm')){
        let confirmation = document.querySelectorAll('a.confirm');
        for(let i=0; i<confirmation.length; i++){
            if(document.querySelectorAll('a.confirm')){
                let message = (confirmations[i].dataset.message) ? confirmations[i].dataset.message :
                 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                 confirmations[i].onclick = () => {
                     return (window.confirm(message));
                 }
            }
        }
    
    }
    //gestion du drag & drop des photos
    if(document.getElementById('photo1')){
        document.addEventListener('dragover',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo1').style.border = '4px dashed blue';
        });
        document.addEventListener('dragleave',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo1').style.border = '';
        });
        document.addEventListener('drop',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo1').style.border = '';

        });
        document.getElementById('photo1').addEventListener('drop',(e)=>{
            document.getElementById('photo1').style.border = '';
            let fichier = e.dataTransfer.files;
            document.getElementById('file1').files = fichier;

            let event = new Event('change');
            document.getElementById('file1').dispatchEvent(event);
        });

    }

})
//Photo2
document.addEventListener('DOMContentLoaded', function(){

    if(document.getElementById(`photo2`)){
        document.getElementById('file2').addEventListener('change', function(event){
            let fichier = event.target.files[0];
            console.log(fichier);
            let ext = ['image/jpeg', 'image/png']
            if(ext.includes(fichier.type)){
            let reader = new FileReader();
            reader.readAsDataURL(fichier);
            reader.onload = (e) => {
                document.querySelector(`#photo2 img`).setAttribute('src',e.target.result);
                //pour les annonces

                if(document.getElementById('nom_original')){
                    document.getElementById('nom_original').setAttribute('value', fichier.name);
                    document.getElementById('data_img').setAttribute('value', e.target.result);
                }
            }
        }
        });
    }
    if(document.querySelectorAll('a.confirm')){
        let confirmation = document.querySelectorAll('a.confirm');
        for(let i=0; i<confirmation.length; i++){
            if(document.querySelectorAll('a.confirm')){
                let message = (confirmations[i].dataset.message) ? confirmations[i].dataset.message :
                 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                 confirmations[i].onclick = () => {
                     return (window.confirm(message));
                 }
            }
        }
    
    }
    //gestion du drag & drop des photos
    if(document.getElementById('photo2')){
        document.addEventListener('dragover',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo2').style.border = '4px dashed blue';
        });
        document.addEventListener('dragleave',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo2').style.border = '';
        });
        document.addEventListener('drop',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo2').style.border = '';

        });
        document.getElementById('photo2').addEventListener('drop',(e)=>{
            document.getElementById('photo2').style.border = '';
            let fichier = e.dataTransfer.files;
            document.getElementById('file2').files = fichier;

            let event = new Event('change');
            document.getElementById('file2').dispatchEvent(event);
        });

    }

})
//Photo3
document.addEventListener('DOMContentLoaded', function(){

    if(document.getElementById(`photo3`)){
        document.getElementById('file3').addEventListener('change', function(event){
            let fichier = event.target.files[0];
            console.log(fichier);
            let ext = ['image/jpeg', 'image/png']
            if(ext.includes(fichier.type)){
            let reader = new FileReader();
            reader.readAsDataURL(fichier);
            reader.onload = (e) => {
                document.querySelector(`#photo3 img`).setAttribute('src',e.target.result);
                //pour les annonces

                if(document.getElementById('nom_original')){
                    document.getElementById('nom_original').setAttribute('value', fichier.name);
                    document.getElementById('data_img').setAttribute('value', e.target.result);
                }
            }
        }
        });
    }
    if(document.querySelectorAll('a.confirm')){
        let confirmation = document.querySelectorAll('a.confirm');
        for(let i=0; i<confirmation.length; i++){
            if(document.querySelectorAll('a.confirm')){
                let message = (confirmations[i].dataset.message) ? confirmations[i].dataset.message :
                 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                 confirmations[i].onclick = () => {
                     return (window.confirm(message));
                 }
            }
        }
    
    }
    //gestion du drag & drop des photos
    if(document.getElementById('photo3')){
        document.addEventListener('dragover',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo3').style.border = '4px dashed blue';
        });
        document.addEventListener('dragleave',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo3').style.border = '';
        });
        document.addEventListener('drop',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo3').style.border = '';

        });
        document.getElementById('photo3').addEventListener('drop',(e)=>{
            document.getElementById('photo3').style.border = '';
            let fichier = e.dataTransfer.files;
            document.getElementById('file3').files = fichier;

            let event = new Event('change');
            document.getElementById('file3').dispatchEvent(event);
        });

    }

})
//Photo4
document.addEventListener('DOMContentLoaded', function(){

    if(document.getElementById(`photo4`)){
        document.getElementById('file4').addEventListener('change', function(event){
            let fichier = event.target.files[0];
            console.log(fichier);
            let ext = ['image/jpeg', 'image/png']
            if(ext.includes(fichier.type)){
            let reader = new FileReader();
            reader.readAsDataURL(fichier);
            reader.onload = (e) => {
                document.querySelector(`#photo4 img`).setAttribute('src',e.target.result);
                //pour les annonces

                if(document.getElementById('nom_original')){
                    document.getElementById('nom_original').setAttribute('value', fichier.name);
                    document.getElementById('data_img').setAttribute('value', e.target.result);
                }
            }
        }
        });
    }
    if(document.querySelectorAll('a.confirm')){
        let confirmation = document.querySelectorAll('a.confirm');
        for(let i=0; i<confirmation.length; i++){
            if(document.querySelectorAll('a.confirm')){
                let message = (confirmations[i].dataset.message) ? confirmations[i].dataset.message :
                 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                 confirmations[i].onclick = () => {
                     return (window.confirm(message));
                 }
            }
        }
    
    }
    //gestion du drag & drop des photos
    if(document.getElementById('photo4')){
        document.addEventListener('dragover',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo4').style.border = '4px dashed blue';
        });
        document.addEventListener('dragleave',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo4').style.border = '';
        });
        document.addEventListener('drop',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo4').style.border = '';

        });
        document.getElementById('photo4').addEventListener('drop',(e)=>{
            document.getElementById('photo4').style.border = '';
            let fichier = e.dataTransfer.files;
            document.getElementById('file4').files = fichier;

            let event = new Event('change');
            document.getElementById('file4').dispatchEvent(event);
        });

    }

})
//Photo5
document.addEventListener('DOMContentLoaded', function(){

    if(document.getElementById(`photo5`)){
        document.getElementById('file5').addEventListener('change', function(event){
            let fichier = event.target.files[0];
            console.log(fichier);
            let ext = ['image/jpeg', 'image/png']
            if(ext.includes(fichier.type)){
            let reader = new FileReader();
            reader.readAsDataURL(fichier);
            reader.onload = (e) => {
                document.querySelector(`#photo5 img`).setAttribute('src',e.target.result);
                //pour les annonces

                if(document.getElementById('nom_original')){
                    document.getElementById('nom_original').setAttribute('value', fichier.name);
                    document.getElementById('data_img').setAttribute('value', e.target.result);
                }
            }
        }
        });
    }
    if(document.querySelectorAll('a.confirm')){
        let confirmation = document.querySelectorAll('a.confirm');
        for(let i=0; i<confirmation.length; i++){
            if(document.querySelectorAll('a.confirm')){
                let message = (confirmations[i].dataset.message) ? confirmations[i].dataset.message :
                 'Êtes-vous sûr de vouloir supprimer cet élément ?';
                 confirmations[i].onclick = () => {
                     return (window.confirm(message));
                 }
            }
        }
    
    }
    //gestion du drag & drop des photos
    if(document.getElementById('photo5')){
        document.addEventListener('dragover',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo5').style.border = '4px dashed blue';
        });
        document.addEventListener('dragleave',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo5').style.border = '';
        });
        document.addEventListener('drop',(e)=>{
            e.stopPropagation();
            e.preventDefault();
            document.getElementById('photo5').style.border = '';

        });
        document.getElementById('photo5').addEventListener('drop',(e)=>{
            document.getElementById('photo5').style.border = '';
            let fichier = e.dataTransfer.files;
            document.getElementById('file5').files = fichier;

            let event = new Event('change');
            document.getElementById('file5').dispatchEvent(event);
        });

    }

})

//Autocompletion connexion https://api-adresse.data.gouv.fr/search/?city=

$("#cp").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "https://api-adresse.data.gouv.fr/search/?postcode="+$("input[name='cp']").val(),
			data: { q: request.term },
			dataType: "json",
			success: function (data) {
				var postcodes = [];
				response($.map(data.features, function (item) {
					// Ici on est obligé d'ajouter les CP dans un array pour ne pas avoir plusieurs fois le même
					if ($.inArray(item.properties.postcode, postcodes) == -1) {
						postcodes.push(item.properties.postcode);
						return { label: item.properties.postcode + " - " + item.properties.city, 
								 city: item.properties.city,
								 value: item.properties.postcode
						};
					}
				}));
			}
		});
	},
	// On remplit aussi la ville
	select: function(event, ui) {
		$('#ville').val(ui.item.city);
	}
});
$("#ville").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "https://api-adresse.data.gouv.fr/search/?city="+$("input[name='ville']").val(),
			data: { q: request.term },
			dataType: "json",
			success: function (data) {
				var cities = [];
				response($.map(data.features, function (item) {
					// Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
					if ($.inArray(item.properties.postcode, cities) == -1) {
						cities.push(item.properties.postcode);
						return { label: item.properties.postcode + " - " + item.properties.city, 
								 postcode: item.properties.postcode,
								 value: item.properties.city
						};
					}
				}));
			}
		});
	},
	// On remplit aussi le CP
	select: function(event, ui) {
		$('#cp').val(ui.item.postcode);
	}
});
$("#adresse").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "https://api-adresse.data.gouv.fr/search/?postcode="+$("input[name='cp']").val(),
			data: { q: request.term },
			dataType: "json",
			success: function (data) {
				response($.map(data.features, function (item) {
					return { label: item.properties.name, value: item.properties.name};
				}));
			}
		});
	}
});
//code jquery pour la table page gestion_membres.php

$(document).ready(function() {
    $('#membres').DataTable();
} );
//code d'update des champs du formulaire 
document.addEventListener('DOMContentLoaded', function () {


    const bouton = document.getElementById('editer');
    const pseudo = document.getElementById('message');
    const dialogue = document.getElementById('dialogue');

    bouton.addEventListener('click', function () {

        if (pseudo.value != '') {

            console.log(pseudo.value);
            let formdata = new FormData();
            formdata.append('pseudo', pseudo.value);

            let body = {
                'method': 'POST',
                'body': formdata
            };

            fetch('gestion_membres.php', body)
                .then(function (response) {
                    return response.json();
                })
                .then(function (datas) {
                    console.log(datas);
                    if (datas) {
                        if (datas.insertion == 'ok') {
                            dialogue.innerHTML = '👍 Insertion effectuée';
                            pseudo.value = '';
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    });
});