document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const body = document.body;
    
    // Verifica se os elementos existem antes de adicionar event listeners
    if (openBtn && sidebar && closeBtn) {
        // Abrir sidebar
        openBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.add('active');
            body.classList.add('sidebar-open');
        });
        
        // Fechar sidebar
        closeBtn.addEventListener('click', function() {
            sidebar.classList.remove('active');
            body.classList.remove('sidebar-open');
        });
        
        // Fechar ao clicar fora da sidebar
        document.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target)) {
                sidebar.classList.remove('active');
                body.classList.remove('sidebar-open');
            }
        });
        
        // Fechar ao clicar em links da sidebar
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                sidebar.classList.remove('active');
                body.classList.remove('sidebar-open');
            });
        });
        
        // Prevenir propagação do clique dentro da sidebar
        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Adiciona classe de carregamento para transições suaves
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);
});