<style>
    .message-card {
        max-width: 75%;
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        background: #f5f5f5;
    }
    .user-message {
        background-color: #e1ffc7;
        align-self: flex-end;
    }
    .bot-message {
        background-color: #fff;
        align-self: flex-start;
    }
    .message-time {
        display: block;
        margin-top: 5px;
        font-size: 0.85em;
        text-align: right;
    }
    @media (max-width: 767.98px) {
        .drawer-menu {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 75%;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        .drawer-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        .drawer-open .drawer-menu {
            transform: translateX(0);
        }
        .drawer-open .drawer-backdrop {
            display: block;
        }
    }
</style>