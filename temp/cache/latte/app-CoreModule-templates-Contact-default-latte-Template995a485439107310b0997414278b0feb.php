<?php
// source: C:\Users\Lenovo\Documents\Nette\simple-editor-system-nette\app\CoreModule/templates/Contact/default.latte

class Template995a485439107310b0997414278b0feb extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('656a072660', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbce1ac1644f_title')) { function _lbce1ac1644f_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Kontaktný formulár<?php
}}

//
// block description
//
if (!function_exists($_b->blocks['description'][] = '_lb08c5a71635_description')) { function _lb08c5a71635_description($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Kontaktný formulár.<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb1c6314ac51_content')) { function _lb1c6314ac51_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><p>Kontaktujte nás odoslaním formulára uvedeného nižšie.</p>
<?php $_l->tmp = $_control->getComponent("contactForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>


<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}