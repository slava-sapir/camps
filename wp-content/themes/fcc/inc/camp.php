<?php

class Camp
{
    public array $args = [
        'post_type'   => 'page',
        'sort_column' => 'post_date'
    ];

    public int $active_camp;

    public array $parent_pages = [
        418 => 'day-camps',
        429 => 'overnight-camps',
        431 => 'schools-groups'
    ];
    private WP_Post $post;
    private string $logo;

    public function __construct(WP_Post $post)
    {
        $this->post = $post;
        $this->logo = get_template_directory_uri() . '/resources/images/main-theme/logos/forest-cliff-camps-logo-original.svg';
        $this->active_camp = 0;
    }

    public function get_logo(): string
    {
        return $this->logo;
    }

    public function get_submenu_items(): array
    {
        return get_pages($this->args);
    }

    public function is_camp_page(): bool
    {
        if ($this->post->post_parent) {
            if (in_array($this->post->post_parent, array_keys($this->parent_pages))) {
                $this->args['parent'] = $this->active_camp = $this->post->post_parent;
                $this->logo = get_template_directory_uri() . '/resources/images/day-camp-theme/logos/forest-cliff-camps-logo-white.svg';
                return true;
            }
        } else {
            if (in_array($this->post->ID, array_keys($this->parent_pages))) {
                $this->args['parent'] = $this->active_camp = $this->post->ID;
                $this->logo = get_template_directory_uri() . '/resources/images/day-camp-theme/logos/forest-cliff-camps-logo-white.svg';
                return true;
            }
        }

        return false;
    }
}