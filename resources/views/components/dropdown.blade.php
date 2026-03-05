<li class="nav-item dropdown" style="position: relative;">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        {{ $trigger }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" 
         style="position: absolute; z-index: 9999; right: 0;">
        {{ $content }}
    </div>
</li>