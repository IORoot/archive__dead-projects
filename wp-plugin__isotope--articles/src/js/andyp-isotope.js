/*                                                                              
*   ┌─────────────────────────────────────────────────────────────────────────┐ 
*   │                                                                         │░
*   │                                                                         │░
*   │                         Combinations of Selects                         │░
*   │                                                                         │░
*   │                                                                         │░
*   └─────────────────────────────────────────────────────────────────────────┘░
*    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
*/                                                                                                                                                         

/*
Example Isotope setup
init Isotope
*/
window.onload=(function() {

    var $grid = document.querySelector('.grid');
    var iso = Isotope.data( $grid );

    // Update the totals.
    document.getElementById('andyp-isotope__results-total').innerHTML = iso.getFilteredItemElements().length;

    // if blocks are replaced with images
    imagesLoaded( $grid ).on( 'progress', function() {
        iso.layout();
    });


    // Filter
    (function() {

        // get references to select list and display text box
        var $selectFilters = document.querySelectorAll('.andyp-isotope__filters select'),
        $resultsTotal = document.getElementById('andyp-isotope__results-total'),
        filters = {};

        // get selected option
        function getSelectedOption(sel) {
            var opt;
            for ( var i = 0, len = sel.options.length; i < len; i++ ) {
                opt = sel.options[i];
                if ( opt.selected === true ) {
                    break;
                }
            }
            return opt;
        }

        // loop all selects
        for(i=0; i<$selectFilters.length; i++) {

        // add change event to each select
        $selectFilters[i].addEventListener('change', function(event) {  
            
            // get option form select event
            var opt = getSelectedOption(event.target);
            
            // get the data filter group then the value
            var selectGroup = fizzyUIUtils.getParent( event.target, '.andyp-isotope__filter' );
            filters[selectGroup.dataset.filterGroup] = opt.value;

            var isoFilters = [];
            for (var group in filters) {         
                isoFilters.push(filters[group])
            }

            var selector = concatValues(isoFilters);
            
            iso.arrange({
                filter: selector
            });    

            var total = iso.getFilteredItemElements();
            
            $resultsTotal.innerHTML = total.length;

            return false;

        });    

        }   

    }());


    function concatValues( obj ) {
        var value = '';
        for ( var prop in obj ) {
            value += obj[ prop ];
        }

        console.log(value);

        return value;
    }

});


// vanilla JS
// var iso = new Isotope( '.grid', {
//     itemSelector: '.andyp-isotope__cell',
//     layoutMode: 'fitRows'
// });


/*                                                                              
*   ┌─────────────────────────────────────────────────────────────────────────┐ 
*   │                                                                         │░
*   │                                                                         │░
*   │                             Single Buttons                              │░
*   │                                                                         │░
*   │                                                                         │░
*   └─────────────────────────────────────────────────────────────────────────┘░
*    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
*/                                                                              

//  { "itemSelector": ".andyp-isotope__cell", "layoutMode": "fitRows" }

// // bind filter button click
// var filtersElem = document.querySelector('.filters-button-group');
// filtersElem.addEventListener( 'click', function( event ) {
//     // only work with buttons
//     if ( !matchesSelector( event.target, 'button' ) ) {  return; }

//     var filterValue = event.target.getAttribute('data-filter');
//     iso.arrange({ filter: filterValue });
// });

// // change is-checked class on buttons
// var buttonGroups = document.querySelectorAll('.button-group');
// for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
//     var buttonGroup = buttonGroups[i];
//     radioButtonGroup( buttonGroup );
// }

// function radioButtonGroup( buttonGroup ) {
//     buttonGroup.addEventListener( 'click', function( event ) {
//         // only work with buttons
//         if ( !matchesSelector( event.target, 'button' ) ) {
//             return;
//         }
//         buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
//         event.target.classList.add('is-checked');
//     });
// }






/*                                                                              
*   ┌─────────────────────────────────────────────────────────────────────────┐ 
*   │                                                                         │░
*   │                                                                         │░
*   │                         Combinations of Buttons                         │░
*   │                                                                         │░
*   │                                                                         │░
*   └─────────────────────────────────────────────────────────────────────────┘░
*    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
*/                                                                                                                                                         

// // store filter for each group
// var filters = {};

// var filtersElem = document.querySelector('.andyp-isotope__filters');

// filtersElem.addEventListener( 'click', function( event ) {
//     // check for only button clicks
//     var isButton = event.target.classList.contains('button');
//     if ( !isButton ) {
//     return;
// }

// var buttonGroup = fizzyUIUtils.getParent( event.target, '.button-group' );
// var filterGroup = buttonGroup.getAttribute('data-filter-group');
// // set filter for group
// filters[ filterGroup ] = event.target.getAttribute('data-filter');
//     // combine filters
//     var filterValue = concatValues( filters );
//     // set filter for Isotope
//     iso.arrange({ filter: filterValue });
// });

// // change is-checked class on buttons
// var buttonGroups = document.querySelectorAll('.button-group');

// for ( var i=0; i < buttonGroups.length; i++ ) {
//     var buttonGroup = buttonGroups[i];
//     var onButtonGroupClick = getOnButtonGroupClick( buttonGroup );
//     buttonGroup.addEventListener( 'click', onButtonGroupClick );
// }

// function getOnButtonGroupClick( buttonGroup ) {
//     return function( event ) {
//     // check for only button clicks
//     var isButton = event.target.classList.contains('button');
//     if ( !isButton ) {
//         return;
//     }
//     var checkedButton = buttonGroup.querySelector('.is-checked');
//     checkedButton.classList.remove('is-checked')
//     event.target.classList.add('is-checked');
//     }
// }

// // flatten object by concatting values
// function concatValues( obj ) {
//     var value = '';
//     for ( var prop in obj ) {
//         value += obj[ prop ];
//     }
//     return value;
// }