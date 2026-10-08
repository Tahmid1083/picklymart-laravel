<aside class="cat-panel">
    <div class="cat-panel-title">All Categories</div>
    <nav class="cat-list">
        @foreach ($sidebarCategories as $cat)
            <a class="{{ $cat->children->count() ? 'has-sub' : '' }}" href="{{ route('category.show', $cat->slug) }}">
                <span class="cat-icon"><img src="{{ asset('images/icons/' . ($cat->icon ?: 'placeholder.svg')) }}" alt=""></span>
                <span>{{ $cat->name }}</span>
            </a>
            @if ($cat->children->count())
                <div class="sub-list">
                    @foreach ($cat->children as $child)
                        <a href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
                    @endforeach
                </div>
            @endif
        @endforeach
    </nav>
</aside>
