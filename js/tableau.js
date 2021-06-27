//code jquery pour la table page gestion_membres.php

// $(document).ready(function() {
//     $('#tableau1').DataTable();
// } );
$(document).ready(function() {
    $('#tableau2').DataTable( {
        language: {
            url: 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
        }
    } );
} );
$(document).ready(function() {
    $('#tableau3').DataTable( {
        
        
        language: {
            url: 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json',
        },
       
    } );
} );
console.log(`hello`);