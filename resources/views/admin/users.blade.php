@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')
@section('page-subtitle', 'Kelola akun admin, shelter, dan donatur')

@section('content')
<div class="space-y-6">
    @if(session('success'))
        <x-alert type="success" dismissible>{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="danger" dismissible>{{ session('error') }}</x-alert>
    @endif
    @if($errors->any())
        <x-alert type="danger" dismissible>{{ $errors->first() }}</x-alert>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <x-stat-card label="Total Admin"   :value="$admins->count()"   icon="user-shield"  tone="brand" />
        <x-stat-card label="Total Shelter" :value="$shelters->count()" icon="home"         tone="info" />
        <x-stat-card label="Total Donatur" :value="$donaturs->count()" icon="users"        tone="success" />
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3">
        <p class="text-sm text-ink-600 dark:text-ink-300">
            <i class="fas fa-circle-info mr-1 text-brand-500"></i>
            Tombol <strong class="text-ink-900 dark:text-white">"Jadikan Admin"</strong> akan memberikan akses admin tanpa menghapus role asli pengguna.
        </p>
        <x-button type="button" onclick="document.getElementById('addUserModal').classList.remove('hidden'); document.getElementById('addUserModal').classList.add('flex')" variant="primary" size="md" icon="user-plus">Tambah Akun</x-button>
    </div>

    <x-table-card title="Akun Admin" :subtitle="$admins->count() . ' admin terdaftar'">
        @if($admins->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Terdaftar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($admins as $i => $a)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center text-white font-bold text-sm shadow-md">
                                        {{ strtoupper(substr($a->username, 0, 1)) }}
                                    </span>
                                    <div>
                                        <p class="font-semibold text-ink-900 dark:text-white">{{ $a->username }}</p>
                                        @if($a->id == $currentAdminId)
                                            <x-badge type="brand" class="mt-0.5"><i class="fas fa-user"></i> Anda</x-badge>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400 text-xs">{{ $a->created_at?->format('d M Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($a->id == $currentAdminId)
                                    <span class="text-xs text-ink-400 italic">Tidak dapat dihapus</span>
                                @else
                                    <form action="{{ route('admin.users.destroy', ['type' => 'admin', 'id' => $a->id]) }}" method="POST" onsubmit="return confirm('Cabut akses admin untuk {{ $a->username }}?')" class="inline">
                                        @csrf @method('DELETE')
                                        <x-button type="submit" variant="danger" size="sm" icon="user-minus">Cabut Admin</x-button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="user-shield" title="Belum ada admin" />
        @endif
    </x-table-card>

    <x-table-card title="Akun Shelter" :subtitle="$shelters->count() . ' shelter terdaftar'">
        @if($shelters->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Shelter</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Lokasi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($shelters as $i => $s)
                        @php $isAdmin = in_array($s->username, $adminUsernames); @endphp
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-ink-900 dark:text-white">{{ $s->nama_shelter }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $s->username }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $s->lokasi }}</td>
                            <td class="px-6 py-4 text-center">
                                <x-badge type="info"><i class="fas fa-home"></i> Shelter</x-badge>
                                @if($isAdmin)
                                    <x-badge type="brand" class="ml-1"><i class="fas fa-user-shield"></i> Admin</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    @if(!$isAdmin)
                                        <form action="{{ route('admin.users.promote', ['type' => 'shelter', 'id' => $s->id]) }}" method="POST" onsubmit="return confirm('Jadikan {{ $s->username }} sebagai admin?')">
                                            @csrf
                                            <x-button type="submit" variant="success" size="sm" icon="user-shield">Jadikan Admin</x-button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.users.destroy', ['type' => 'shelter', 'id' => $s->id]) }}" method="POST" onsubmit="return confirm('Hapus shelter {{ $s->nama_shelter }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf @method('DELETE')
                                        <x-button type="submit" variant="danger" size="sm" icon="trash">Hapus</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="home" title="Belum ada shelter" />
        @endif
    </x-table-card>

    <x-table-card title="Akun Donatur" :subtitle="$donaturs->count() . ' donatur terdaftar'">
        @if($donaturs->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-ink-200 dark:border-ink-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400 w-12">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Telepon</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-ink-500 dark:text-ink-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink-100 dark:divide-ink-700">
                    @foreach($donaturs as $i => $d)
                        @php $isAdmin = in_array($d->username, $adminUsernames); @endphp
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-900/40 transition-colors">
                            <td class="px-6 py-4 text-ink-500 dark:text-ink-400">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-ink-900 dark:text-white">{{ $d->username }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $d->email }}</td>
                            <td class="px-6 py-4 text-ink-700 dark:text-ink-200">{{ $d->no_telepon ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <x-badge type="success"><i class="fas fa-user"></i> Donatur</x-badge>
                                @if($isAdmin)
                                    <x-badge type="brand" class="ml-1"><i class="fas fa-user-shield"></i> Admin</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    @if(!$isAdmin)
                                        <form action="{{ route('admin.users.promote', ['type' => 'donatur', 'id' => $d->id]) }}" method="POST" onsubmit="return confirm('Jadikan {{ $d->username }} sebagai admin?')">
                                            @csrf
                                            <x-button type="submit" variant="success" size="sm" icon="user-shield">Jadikan Admin</x-button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.users.destroy', ['type' => 'donatur', 'id' => $d->id]) }}" method="POST" onsubmit="return confirm('Hapus donatur {{ $d->username }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf @method('DELETE')
                                        <x-button type="submit" variant="danger" size="sm" icon="trash">Hapus</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <x-empty-state icon="users" title="Belum ada donatur" />
        @endif
    </x-table-card>
</div>

{{-- Tambah Akun Modal --}}
<div id="addUserModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-ink-900/60 backdrop-blur-sm">
    <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white dark:bg-ink-800 rounded-3xl shadow-2xl">
        <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-800">
            <div>
                <h2 class="text-lg font-bold text-ink-900 dark:text-white">Tambah Akun Baru</h2>
                <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5">Pilih role dan isi data akun.</p>
            </div>
            <button type="button" id="closeAddUser" class="w-9 h-9 rounded-lg flex items-center justify-center text-ink-500 hover:bg-ink-100 dark:hover:bg-ink-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            <x-form.group label="Role" for="role" required>
                <select id="role" name="role" required onchange="toggleRoleFields(this.value)"
                        class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih role --</option>
                    <option value="admin"   @selected(old('role') === 'admin')>Admin</option>
                    <option value="shelter" @selected(old('role') === 'shelter')>Shelter</option>
                    <option value="donatur" @selected(old('role') === 'donatur')>Donatur</option>
                </select>
            </x-form.group>

            <div data-role-fields="shelter" class="hidden space-y-5">
                <x-form.group label="Nama Shelter" for="nama_shelter">
                    <x-form.input name="nama_shelter" id="nama_shelter" icon="home" placeholder="cth: Shelter Kucing Bahagia" :value="old('nama_shelter')" />
                </x-form.group>
                <x-form.group label="Lokasi" for="lokasi">
                    <x-form.input name="lokasi" id="lokasi" icon="location-dot" placeholder="cth: Jakarta Selatan" :value="old('lokasi')" />
                </x-form.group>
            </div>

            <div data-role-fields="donatur" class="hidden space-y-5">
                <x-form.group label="Email" for="email">
                    <x-form.input type="email" name="email" id="email" icon="envelope" placeholder="email@contoh.com" :value="old('email')" />
                </x-form.group>
                <x-form.group label="Nomor Telepon" for="no_telepon" hint="opsional">
                    <x-form.input name="no_telepon" id="no_telepon" icon="phone" placeholder="08xx-xxxx-xxxx" :value="old('no_telepon')" />
                </x-form.group>
            </div>

            <x-form.group label="Username" for="username" required>
                <x-form.input name="username" id="username" icon="at" placeholder="username" :value="old('username')" required />
            </x-form.group>

            <x-form.group label="Password" for="password" required hint="Minimal 6 karakter.">
                <x-form.input type="password" name="password" id="password" icon="lock" placeholder="********" required />
            </x-form.group>

            <div class="flex gap-3 pt-2">
                <x-button type="button" id="cancelAddUser" variant="ghost" size="md" class="flex-1">Batal</x-button>
                <x-button type="submit" variant="primary" size="md" icon="user-plus" class="flex-1">Buat Akun</x-button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function() {
    const modal = document.getElementById('addUserModal');
    const open  = () => { modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; };
    const close = () => { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; };

    document.getElementById('closeAddUser').addEventListener('click', close);
    document.getElementById('cancelAddUser').addEventListener('click', close);
    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });

    window.toggleRoleFields = (role) => {
        document.querySelectorAll('[data-role-fields]').forEach((el) => {
            const show = el.dataset.roleFields === role;
            el.classList.toggle('hidden', !show);
            el.querySelectorAll('input, select').forEach((inp) => {
                inp.required = show && inp.name !== 'no_telepon';
            });
        });
    };

    // If validation error reopened modal, restore role
    @if(old('role'))
        open();
        toggleRoleFields('{{ old('role') }}');
    @endif
})();
</script>
@endpush
@endsection
