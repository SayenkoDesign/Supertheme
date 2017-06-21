<?php
// save acf as json
add_filter('acf/settings/save_json', function ($path) use($container) {
    return $container->getParameterBag()->resolveValue($container->getParameter('wordpress.acf_path'));
});

// show/hide acf menus
add_filter('acf/settings/show_admin', function ($show) use($container) {
    return $container->getParameter('wordpress.acf_menu');
});

// create fields based on yml
if(function_exists('acf_add_local_field_group')){
    $parser = new \Symfony\Component\Yaml\Parser();
    $fields = $parser->parse(file_get_contents(__DIR__.'/../../app/acf/theme_options.yml'));
    acf_add_local_field_group($fields);
}
