acf.add_filter('color_picker_args', function( args, $field ){

    // do something to args
    args.palettes = [
        '#fbc02d',      // Yellow
        '#000000',      // Black
        '#242424',      // Darker Grey
        '#424242',      // Dark Grey
        '#757575',      // Grey
        '#e0e0e0',      // Light Grey
        '#ffffff',      // White
        '#69f0ae',      // Cyan
        '#ff5252',      // Salmon
        '#1a237e'       // Blue
    ];


    // return
    return args;

});