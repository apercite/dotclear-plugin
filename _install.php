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

$version = $core->plugins->moduleInfo('apercite', 'version');
if (version_compare($core->getVersion('apercite'), $version, '>='))
{
  return;
}

$core->blog->settings->addNameSpace('apercite');

if (!$core->blog->settings->apercite->get('enabled'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_enabled')) ? $core->blog->settings->apercite->get('apercite_enabled') : 1;

  $core->blog->settings->apercite->put('enabled', $value, 'boolean');
}
if (!$core->blog->settings->apercite->get('size'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_size')) ? $core->blog->settings->apercite->get('apercite_size') : '120x90';

  $core->blog->settings->apercite->put('size', $value);
}
if (!$core->blog->settings->apercite->get('javascript'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_javascript')) ? $core->blog->settings->apercite->get('apercite_javascript') : 1;

  $core->blog->settings->apercite->put('javascript', $value, 'boolean');
}
if (!$core->blog->settings->apercite->get('java'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_java')) ? $core->blog->settings->apercite->get('apercite_java') : 1;

  $core->blog->settings->apercite->put('java', $value, 'boolean');
}
if (!$core->blog->settings->apercite->get('login'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_login')) ? $core->blog->settings->apercite->get('apercite_login') : '';

  $core->blog->settings->apercite->put('login', $value);
}
if (!$core->blog->settings->apercite->get('apiKey'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_api_key')) ? $core->blog->settings->apercite->get('apercite_api_key') : '';

  $core->blog->settings->apercite->put('apiKey', $value);
}

if (!$core->blog->settings->apercite->get('localLink'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_local_link')) ? $core->blog->settings->apercite->get('apercite_local_link') : 1;

  $core->blog->settings->apercite->put('localLink', $value, 'boolean');
}

if (!$core->blog->settings->apercite->get('workers'))
{
  $value = !is_null($core->blog->settings->apercite->get('apercite_workers')) ? @unserialize($core->blog->settings->apercite->get('apercite_workers')) : array('.post-excerpt', '.post-content');

  $core->blog->settings->apercite->put('workers', serialize($value));
}

try
{
  $strReq = "DELETE
    FROM ".$core->prefix."setting
    WHERE setting_id LIKE 'apercite_%'";
	$core->con->execute($strReq);
}
catch (Exception $e)
{
}

$core->setVersion('apercite', $version);
?>
