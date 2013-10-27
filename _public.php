<?php

/*
 * This file is part of the plugin Apercite for DotClear.
 *
 * (c) Francis Besset <francis.besset@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!defined('DC_RC_PATH')) { return; }

$core->addBehavior('publicHeadContent',   array('ApercitePublic','publicHeadContent'));
$core->addBehavior('publicFooterContent', array('ApercitePublic','publicFooterContent'));

class ApercitePublic
{
  public static function publicHeadContent($core)
  {
    if (!$core->blog->settings->apercite->enabled)
    {
      return;
    }

    $url = $core->blog->getQmarkURL().'pf='.basename(dirname(__FILE__));

    $size       = ($core->blog->settings->apercite->size       || $core->blog->settings->apercite->size === null ? explode('x', $core->blog->settings->apercite->size) : array(120,90));
    $javascript = ($core->blog->settings->apercite->javascript || $core->blog->settings->apercite->javascript === null ? 'oui' : 'non');
    $java       = ($core->blog->settings->apercite->java       || $core->blog->settings->apercite->java === null ? 'oui' : 'non');
    $workers    = @unserialize($core->blog->settings->apercite->workers);

    if (!$workers)
    {
      $workers = array();
    }

    echo
      '<style type="text/css">
        @import url('.$url.'/css/style.css);
      </style>
      <script type="text/javascript" src="'.$url.'/js/apercite.js"></script>
      <script type="text/javascript">
        //<![CDATA[
          $(function() {
            $("body").apercite({
              "workers":Array('."\n";
                foreach ($workers as $k=>$v)
                {
                  if ($k)
                  {
                    echo ','."\n";
                  }

                  echo '"'.html::escapeHTML($v).'"';
                }
    echo
              "\n".'),
              "baseURL":"'.$core->blog->host.'",
              "localLink":"'.($core->blog->settings->apercite->localLink || $core->blog->settings->apercite->localLink === null ? 'oui' : 'non').'",
              "sizeX":'.$size[0].',
              "sizeY":'.$size[1].',
              "javascript":"'.$javascript.'",
              "java":"'.$java.'"
            });
          });
        //]]>
      </script>'."\n";
  }

  public static function publicFooterContent($core)
  {
    $seo = array(
      'Générateur de miniatures',
      'Screenshot',
      'AscreeN',
      'Miniatures de site',
      'Thumbnail',
      'Miniature',
      'Aperçu de site',
      'Thumb de site',
      'Générateur AscreeN',
      'Apercite',
    );
    
    if (!empty($_SERVER['REQUEST_URI']))
    {
      $num = (string)(int)md5($_SERVER['REQUEST_URI']);
      $num = $num{0};
    }
    else
    {
      $num = rand(0, 9);
    }

    echo
      '<div id="apercite-thumbnail">
        <a href="http://www.apercite.fr/" title="'.$seo[$num].'">'.$seo[$num].'</a>
      </div>'."\n";
  }
}
?>
