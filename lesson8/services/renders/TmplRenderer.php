<?php

namespace App\services\renders;

class TmplRenderer implements IRenderer
{
    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layauts/main',
            [
                'content' => $content,
                'msg' => $params['msg'],
                'menu' => $params['menu'],

            ]
        );
    }

    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__, 2) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}
