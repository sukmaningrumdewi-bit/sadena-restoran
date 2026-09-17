<header class="topbar">
  <span class="topbar-user">{{ auth()->user()->nama ?? auth()->user()->name ?? 'Budi Santoso' }}</span>
  <div class="avatar">
    {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'BS', 0, 2)) }}
  </div>
</header>