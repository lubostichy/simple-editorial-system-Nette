<?php
// source: C:\Users\Lenovo\Documents\Nette\simple-editor-system-nette\app\CoreModule/templates/Administration/default.latte

class Template8b1ed7fc24842a6e34b754f94a9a40a6 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('62915c2a82', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb118e5c4b3e_title')) { function _lb118e5c4b3e_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Administrácia webu<?php
}}

//
// block description
//
if (!function_exists($_b->blocks['description'][] = '_lbb6248085c3_description')) { function _lbb6248085c3_description($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Administrácia webu.<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6efbe06617_content')) { function _lb6efbe06617_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><p>Vitajte v administrácií! Ste prihlásený ako <b><?php echo Latte\Runtime\Filters::escapeHtml($username, ENT_NOQUOTES) ?></b>.</p>
<?php if (!$admin) { ?><p>Nemáte administrátorské oprávnenia, požiadajte administátora webu, aby Vám ich pridelil.</p>
<?php } ?>
<h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:editor"), ENT_COMPAT) ?>
">Editor článkov</a></h2>
<h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:list"), ENT_COMPAT) ?>
">Zoznam článkov</a></h2>
<h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Administration:logout"), ENT_COMPAT) ?>
">Odhlásiť</a></h2><?php
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