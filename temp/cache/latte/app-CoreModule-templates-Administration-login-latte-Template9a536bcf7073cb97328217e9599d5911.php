<?php
// source: C:\Users\Lenovo\Documents\Nette\simple-editor-system-nette\app\CoreModule/templates/Administration/login.latte

class Template9a536bcf7073cb97328217e9599d5911 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('b2d068a288', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb32733c4bfe_title')) { function _lb32733c4bfe_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Prihlásenie<?php
}}

//
// block description
//
if (!function_exists($_b->blocks['description'][] = '_lb928bfa2b0f_description')) { function _lb928bfa2b0f_description($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Prihlásenie do používateľského účta.<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3d46669072_content')) { function _lb3d46669072_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("loginForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
<p>Pokiaľ ešte nemáte účet, <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Administration:register"), ENT_COMPAT) ?>
">zaregistrujte sa</a>.</p><?php
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