<?php
// source: C:\Users\Lenovo\Documents\Nette\simple-editor-system-nette\app\CoreModule/templates/Administration/register.latte

class Templatee2cb196644dfea60dce6015681598789 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5a8e3eb91c', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbc95396ae52_title')) { function _lbc95396ae52_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Registrácia<?php
}}

//
// block description
//
if (!function_exists($_b->blocks['description'][] = '_lb17bfcdcd59_description')) { function _lb17bfcdcd59_description($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Registrácia nového používateľského účta.<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbaaa2ef2a64_content')) { function _lbaaa2ef2a64_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("registerForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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