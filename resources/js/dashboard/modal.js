import focusTrap from './focus-trap';

export default (modalId) => ({
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
        this.isModalOpen = true
        this.trapCleanup = focusTrap(document.getElementById(modalId))
    },
    closeModal() {
        this.isModalOpen = false
        this.trapCleanup()
    },
});
