<?php
// source: C:\Users\Lenovo\Documents\Nette\simple-editor-system-nette\app/templates/@layout.latte

class Template0f2943884426720d2e465e9188d5ccaf extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('bc8e08f39f', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block css
//
if (!function_exists($_b->blocks['css'][] = '_lb97f04d872b_css')) { function _lb97f04d872b_css($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css" type="text/css">
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb86761db4d8_scripts')) { function _lb86761db4d8_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="//nette.github.io/resources/js/netteForms.min.js"></script>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html lang="sk-SK">
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Web</title>
        <meta name="description" content="<?php ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'description', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>">

	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
        
<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['css']), $_b, get_defined_vars())  ?>
</head>

<body>
        <header>
            <h1>Jednoduchý redakčný systém v Nette</h1>
        </header>
    
<?php $iterations = 0; foreach ($flashes as $flash) { ?>	<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
        <nav>
            <ul>
                <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:"), ENT_COMPAT) ?>
">Úvod</a></li>
                <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:list"), ENT_COMPAT) ?>
">Zoznam článkov</a></li> 
                <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Contact:"), ENT_COMPAT) ?>
">Kontakt</a></li>  
            </ul>
        </nav>
        <br clear="both">
        <article>
            <header>
                <h1><?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()) ?></h1>
            </header>
            <section>
<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>
            </section>
        </article>

        <footer>
            <p>
                Ukážková aplikácia pre jednoduchý systém v Nette z programátorskej socialnej siete.
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Administration:"), ENT_COMPAT) ?>
">Administrácia</a>
            </p>
        </footer>
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>
</body>
</html><?php
}}