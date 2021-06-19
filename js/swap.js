

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
//Slider du fichier annonce
$(document).ready(function(){
    $('#price_range').slider({
        range:true,
        min:1,
        max:3000000,
        values:[1, 3000000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            data_filtrer();
        }
    });
});
//Récupération des données de filtrage
$(document).ready(function(){
    data_filtrer();

    function data_filtrer()
    {
        $('.data_filtrer').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        console.log(maximum_price);
        var categorie = get_filter('categorie');
        var region = get_filter('region');
        var divers = get_filter('divers');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, categorie:categorie, region:region, divers:divers},
            success:function(data){
                $('.data_filtrer').html(data);
                
                console.log(maximum_price);
                console.log(categorie);
            }
        });
    }
 
     function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        data_filtrer();
    });



});


// //Récupération des données de annonces.json
// $(document).ready(function () {
    
    
    
    
//     $.ajax({
//         type: "GET",
//         url: "annonces.json",
//         datatype: "json",
//         success: parseData
//     })

   

    
    

        

//  // affichage des données du json data avec pagination   
 
//  function parseData(data) {  
//     console.log(data);
//     afficher();
//         let nbAnnonce = 0;
//         nbAnnonce = (data.length);
//         nbAnnonceParPage = 4;
//         let premiere = 0;
//         let pageCourante = 1;
//         let pageMax = Math.ceil(nbAnnonce/nbAnnonceParPage);
        
       
//         $('#premiere').click(function (){
//             premiere=0;
//              pageCourante=1;
//              afficher();
            
//             })
//        $('#suivante').click(function (){
//            if(premiere+nbAnnonceParPage<=nbAnnonce){
//             premiere+=nbAnnonceParPage;
//             pageCourante++;
//             afficher();
//            }
//        })
//        $('#precedente').click(function (){
//         if(premiere-nbAnnonceParPage>=0){
//          premiere-=nbAnnonceParPage;
//          pageCourante--;
//          afficher();
//         }
//         })
//         $('#derniere').click(function (){
//         premiere = (pageMax*nbAnnonceParPage)-nbAnnonceParPage;
//         pageCourante = pageMax;
//              afficher();
//             })
//         function afficher(){
//         for (let i=0; i<premiere+nbAnnonceParPage; i++) {
//             console.log(nbAnnonce);
//             if(i<nbAnnonce){
//             $("#content").html(
              
//         `<div class="card mb-3 border-top border-bottom" style="max-width: 800px;" >
//                         <div class="row g-0 align-items-center">
//                             <div class="col-md-4 text-center">
//                                 <img src="./includes/img/`+data[i].photo+`" class="img-fluid rounded w-100">
//                             </div>
//                             <div class="col-md-8">
//                                 <div class="card-body">
//                                     <h5 class="card-title fw-bold fs-5">`+data[i].titre+` Région : `+data[i+1].region+`</h5>
//                                     <p class="card-text">`+data[i].description_courte+data[i].id_annonce+`</p>
//                                     <p class="card-text"><small class="text-muted fw-bold fs-5">Le prix est de: `+data[i].prix+`<sup>€</sup></small></p>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="card mb-3 border-top border-bottom" style="max-width: 800px;" >
//                         <div class="row g-0 align-items-center">
//                             <div class="col-md-4 text-center">
//                                 <img src="./includes/img/`+data[i+1].photo+`" class="img-fluid rounded w-100">
//                             </div>
//                             <div class="col-md-8">
//                                 <div class="card-body">
//                                     <h5 class="card-title fw-bold fs-5">`+data[i+1].titre+` Région : `+data[i+1].region+`</h5>
//                                     <p class="card-text">`+data[i+1].description_courte+data[i+1].id_annonce+`</p>
//                                     <p class="card-text"><small class="text-muted fw-bold fs-5">Le prix est de: `+data[i+1].prix+`<sup>€</sup></small></p>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="card mb-3 border-top border-bottom" style="max-width: 800px;" >
//                         <div class="row g-0 align-items-center">
//                             <div class="col-md-4 text-center">
//                                 <img src="./includes/img/`+data[i+2].photo+`" class="img-fluid rounded w-100">
//                             </div>
//                             <div class="col-md-8">
//                                 <div class="card-body">
//                                     <h5 class="card-title fw-bold fs-5">`+data[i+2].titre+`  Région : `+data[i+1].region+`</h5>
//                                     <p class="card-text">`+data[i+2].description_courte+data[i+2].id_annonce+`</p>
//                                     <p class="card-text"><small class="text-muted fw-bold fs-5">Le prix est de: `+data[i+2].prix+`<sup>€</sup></small></p>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="card mb-3 border-top border-bottom" style="max-width: 800px;" >
//                         <div class="row g-0 align-items-center">
//                             <div class="col-md-4 text-center">
//                                 <img src="./includes/img/`+data[i+3].photo+`" class="img-fluid rounded w-100">
//                             </div>
//                             <div class="col-md-8">
//                                 <div class="card-body">
//                                     <h5 class="card-title fw-bold fs-5">`+data[i+3].titre+`  Région : `+data[i+1].region+`</h5>
//                                     <p class="card-text">`+data[i+3].description_courte+data[i+3].id_annonce+`</p>
//                                     <p class="card-text"><small class="text-muted fw-bold fs-5">Le prix est de: `+data[i+3].prix+`<sup>€</sup></small></p>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     `
                    
//                 )
//             }}
//                 infoPage();
//             }
//             function infoPage(){
//                 $('#infoPage').html(`
                
//                 Page:${pageCourante}/${pageMax}
                
//                 `)

//             }   

        
//     }
// });
