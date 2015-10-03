<?php
// source: C:\Users\Lenovo\Documents\GitHub\simple editor system\app\CoreModule/templates/Article/list.latte

class Template456b92174272a4e8446119560d998eab extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('dc1a131955', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb85522d2f15_title')) { function _lb85522d2f15_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Výpis článkov<?php
}}

//
// block description
//
if (!function_exists($_b->blocks['description'][] = '_lb43d91e9e12_description')) { function _lb43d91e9e12_description($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Výpis všetkých článkov.<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf6f7820e61_content')) { function _lbf6f7820e61_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><table>
<?php $iterations = 0; foreach ($articles as $article) { ?>    <tr>
        <td>
            <h2><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:", array($article->url)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($article->title, ENT_NOQUOTES) ?></a></h2>
            <?php echo Latte\Runtime\Filters::escapeHtml($article->description, ENT_NOQUOTES) ?>

            <br>
<?php if ($admin) { ?>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:editor", array($article->url)), ENT_COMPAT) ?>
">Editovať</a>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Core:Article:remove", array($article->url)), ENT_COMPAT) ?>
">Smazať</a>
<?php } ?>
        </td>        
    </tr>
<?php $iterations++; } ?>
</table><?php
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