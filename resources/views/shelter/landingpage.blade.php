@extends('layout.navbarShelter')
@section('content')
<!-- Main Content -->
<div class="container p-5">
    <h1 style="color: #333; font-size: 2rem; margin-bottom: 0.5rem;">Shelter Campaigns</h1>
    <p style="color: #666; margin-bottom: 2rem;">Daftar kampanye donasi untuk shelter hewan</p>

    <!-- Shelter Items Grid -->
    <div class="shelter-grid" id="shelterGrid">
        <!-- Item akan diisi oleh JavaScript -->
    </div>
</div>

<!-- Floating Action Button -->
<button class="fab" id="fabBtn" title="Tambah Kampanye">
    <i class="fas fa-plus"></i>
</button>

<!-- Modal untuk Tambah Kampanye -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Tambah Kampanye Shelter</h2>
            <button class="close-btn" id="closeBtn">&times;</button>
        </div>
        <form id="addForm">
            <div class="form-group">
                <label for="title">Judul Kampanye</label>
                <input type="text" id="title" name="title" placeholder="Contoh: Pakan Sehat" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" placeholder="Jelaskan detail kampanye..." required></textarea>
            </div>
            <div class="form-group">
                <label for="imageUrl">URL Gambar</label>
                <input type="url" id="imageUrl" name="imageUrl" placeholder="https://..." required>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="cancelBtn">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Kampanye</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data sampel
    const sampleData = [{
            id: 1,
            title: "Pakan Sehat",
            description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor",
            image: "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&h=400&fit=crop"
        },
        {
            id: 2,
            title: "Pakan Sehat",
            description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor",
            image: "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&h=400&fit=crop"
        },
        {
            id: 3,
            title: "Pakan Sehat",
            description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor",
            image: "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&h=400&fit=crop"
        },
        {
            id: 4,
            title: "Pakan Sehat",
            description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor",
            image: "https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=400&h=400&fit=crop"
        }
    ];

    let campaigns = [...sampleData];

    // Render shelter items
    function renderShelterItems() {
        const shelterGrid = document.getElementById('shelterGrid');
        shelterGrid.innerHTML = '';

        campaigns.forEach(campaign => {
            const card = document.createElement('div');
            card.className = 'shelter-card';
            card.innerHTML = `
                    <div class="shelter-card-image">
                        <img src="${campaign.image}" alt="${campaign.title}" onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                    </div>
                    <div class="shelter-card-content">
                        <h3 class="shelter-card-title">${campaign.title}</h3>
                        <p class="shelter-card-description">${campaign.description}</p>
                        <div class="shelter-card-footer">
                            <a href="#" class="detail-link" onclick="handleDetail(event, ${campaign.id})">
                                Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                `;
            shelterGrid.appendChild(card);
        });
    }

    // Handle detail button click
    function handleDetail(event, id) {
        event.preventDefault();
        const campaign = campaigns.find(c => c.id === id);
        alert(`Detail Kampanye: ${campaign.title}\n\n${campaign.description}`);
    }

    // FAB button
    const fabBtn = document.getElementById('fabBtn');
    const addModal = document.getElementById('addModal');
    const closeBtn = document.getElementById('closeBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const addForm = document.getElementById('addForm');

    fabBtn.addEventListener('click', () => {
        addModal.classList.add('active');
    });

    closeBtn.addEventListener('click', () => {
        addModal.classList.remove('active');
    });

    cancelBtn.addEventListener('click', () => {
        addModal.classList.remove('active');
    });

    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === addModal) {
            addModal.classList.remove('active');
        }
    });

    // Handle form submission
    addForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
        const imageUrl = document.getElementById('imageUrl').value;

        const newCampaign = {
            id: campaigns.length + 1,
            title: title,
            description: description,
            image: imageUrl
        };

        campaigns.push(newCampaign);
        renderShelterItems();

        // Reset form dan tutup modal
        addForm.reset();
        addModal.classList.remove('active');

        // Tampilkan notifikasi
        alert('Kampanye berhasil ditambahkan!');
    });

    // Navbar navigation
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    // Initial render
    renderShelterItems();
</script>
@endsection