import axios from 'axios';

/**
 * This class controls authentication:
 * - login
 * - logout
 * - checking permissions
 */
class Auth {

    constructor() {
        // Get saved token (if user already logged in before)
        this.token = localStorage.getItem('token');

        // Get saved user info
        const userData = localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;

        // Get saved permissions (menus user can access)
        const perms = localStorage.getItem('permissions');
        this.permissions = perms ? JSON.parse(perms) : [];

        // If token exists, attach it to all axios requests
        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
    }

    /**
     * Called AFTER successful login
     */
    login(token, user, permissions) {
        // Save to browser
        localStorage.setItem('token', token);
        localStorage.setItem('user', JSON.stringify(user));
        localStorage.setItem('permissions', JSON.stringify(permissions));

        // Attach token to axios
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        // Update class properties
        this.token = token;
        this.user = user;
        this.permissions = permissions;
    }

    /**
     * Check if user is logged in
     */
    check() {
        return !!this.token;
    }

    /**
     * Check if user can access a menu
     */
    hasMenu(menuLink) {
        return this.permissions.some(p => p.menu_link === menuLink);
    }

    /**
     * Get all menus user is allowed to see
     */
    getMenus() {
        return this.permissions;
    }

    /**
     * Logout user
     */
    logout() {
        localStorage.clear();
        this.token = null;
        this.user = null;
        this.permissions = [];
    }
}

export default new Auth();
