<?php

namespace mrugeshtatvasoft\DataTables\Html;

use mrugeshtatvasoft\DataTables\Html\Editor\Editor;

trait HasEditor
{
    /**
     * Collection of Editors.
     */
    protected array $editors = [];

    /**
     * Attach multiple editors to builder.
     *
     * @param  array|mixed  ...$editors
     * @return $this
     *
     * @see https://editor.datatables.net/
     */
    public function editors(...$editors): static
    {
        if (is_array($editors[0])) {
            $editors = $editors[0];
        }

        $this->editors = [];

        foreach ($editors as $editor) {
            if ($editor instanceof Editor) {
                $this->editor($editor);
            } else {
                $this->editor(new Editor($editor));
            }
        }

        return $this;
    }

    /**
     * Integrate with DataTables Editor.
     *
     * @return $this
     *
     * @see https://editor.datatables.net/
     */
    public function editor(Editor $editor): static
    {
        /** @var string $template */
        $template = $this->config->get('datatables-html.editor', 'datatables::editor');

        $this->setTemplate($template);

        if (! $editor->table) {
            $editor->table('#'.$this->getTableAttribute('id'));
        }

        if (! $editor->ajax) {
            $editor->ajax($this->getAjaxUrl());
        }

        $this->editors[] = $editor;

        return $this;
    }

    public function getEditors(): array
    {
        return $this->editors;
    }
}
