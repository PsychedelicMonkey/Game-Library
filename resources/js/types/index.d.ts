import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface Profile {
    id: string;
    avatar: string;
    username: string;
    bio: string | null;
    is_public: boolean;
    created_at: string;
    updated_at: string;
}

export interface SharedData {
    name: string;
    auth: Auth;
    ziggy: Config & { location: string };
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    profile: profile;
    avatar: string | null;
    created_at: string;
    updated_at: string;
}
