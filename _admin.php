<?php

/*
 * This file is part of the plugin Apercite for DotClear.
 *
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!defined('DC_CONTEXT_ADMIN')) { return; }

$_menu['Plugins']->addItem(
  __('Apercite'),'plugin.php?p=apercite','index.php?pf=apercite/icon.png',
  preg_match('/plugin.php\?p=apercite(&.*)?$/',$_SERVER['REQUEST_URI']),
  $core->auth->isSuperAdmin()
);

$__autoload['aperciteBehaviors'] = dirname(__FILE__).'/inc/lib.apercite.php';

$core->addBehavior('adminPostFormSidebar', array('AperciteBehaviors', 'aperciteForm'));
$core->addBehavior('adminAfterPostCreate', array('AperciteBehaviors', 'doUpdate'));
$core->addBehavior('adminAfterPostUpdate', array('AperciteBehaviors', 'doUpdate'));
?>
