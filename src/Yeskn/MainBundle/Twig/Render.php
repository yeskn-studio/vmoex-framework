<?php

/**
 * This file is part of project wpcraft.
 *
 * Author: Jake
 * Create: 2018-10-18 22:51:48
 */

namespace Yeskn\MainBundle\Twig;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Yeskn\MainBundle\Entity\Notice;

class Render extends \Twig_Extension
{
    private $template;

    public function __construct(EngineInterface $template)
    {
        $this->template = $template;
    }

    public function renderNoticeItem(Notice $notice)
    {
        switch ($notice->getType()) {
            case Notice::TYPE_COMMENT_POST:
                return $this->template->render('@YesknMain/user/notices/comment-post.html.twig', ['notice' => $notice]);
            case Notice::TYPE_COMMENT_MENTION:
                return $this->template->render('@YesknMain/user/notices/mention-comment.html.twig', ['notice' => $notice]);
        }

        throw new \Exception('un-support notice type ' . $notice->getType());
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('render_notice_item', array($this,'renderNoticeItem')),
        );
    }
}
