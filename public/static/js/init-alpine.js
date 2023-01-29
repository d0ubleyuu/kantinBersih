const bodyTag = document.querySelector('html');

function data() {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'))
        }

        // else return their preferences
        // return (
        // 	!!window.matchMedia &&
        // 	window.matchMedia('(prefers-color-scheme: dark)').matches
        // )
        return false;
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value)
    }

    function setTheme(value) {
        if (value) {
            bodyTag.classList.add('dark');
        } else {
            bodyTag.classList.remove('dark');
        }
    }

    setTheme(getThemeFromLocalStorage());

    return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark
            setTheme(this.dark);
            setThemeToLocalStorage(this.dark)
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen
        },
        closeSideMenu() {
            this.isSideMenuOpen = false
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
            console.log(this.isNotificationsMenuOpen)
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen
            console.log('heloo')
        },
    }
}
