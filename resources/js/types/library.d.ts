import { Tag } from '@/types/index';

export interface Company {
    id: string;
    name: string;
    slug: string;
    description: string | null;
    is_featured: boolean;
    city: string | null;
    country: string | null;
    date_formed: string | null;
    date_defunct: string | null;
    developedGames: Game[];
    publishedGames: Game[];
    created_at: string;
    updated_at: string;
}

export interface Game {
    id: string;
    title: string;
    slug: string;
    description: string | null;
    cover_art: string | null;
    is_featured: boolean;
    release_date: string | null;
    developers: Company[];
    publishers: Company[];
    genres: Genre[];
    platforms: Platform[];
    ratings_count: number;
    ratings_avg_score: number;
    tags: Tag[];
    created_at: string;
    updated_at: string;
}

export interface Genre {
    id: string;
    name: string;
    slug: string;
    description: string | null;
    is_featured: boolean;
    games: Game[];
    created_at: string;
    updated_at: string;
}

export interface Platform {
    id: string;
    name: string;
    slug: string;
    description: string | null;
    is_featured: boolean;
    release_date: string | null;
    discontinued_date: string | null;
    type: PlatformType;
    games: Game[];
    created_at: string;
    updated_at: string;
}

export interface Rating {
    id: string;
    score: number;
    profile: Profile;
    created_at: string;
    updated_at: string;
}

export interface Review {
    id: string;
    body: string;
    rating: Rating;
    created_at: string;
    updated_at: string;
}

export enum PlatformType {
    CONSOLE,
    SERVICE,
}
