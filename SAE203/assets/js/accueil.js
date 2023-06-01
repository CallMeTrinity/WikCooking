document.querySelectorAll('.coach-card').forEach((card) => {
    card.addEventListener('mouseover', () => {
        card.style.boxShadow = '0 8px 16px 0 rgba(0, 0, 0, 0.2)';
    });

    card.addEventListener('mouseout', () => {
        card.style.boxShadow = '0 4px 8px 0 rgba(0, 0, 0, 0.2)';
    });
});
