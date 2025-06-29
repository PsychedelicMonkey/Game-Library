import { Badge } from '@/components/ui/badge';
import { Card, CardBody, CardTitle } from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';
import { Game } from '@/types/library';
import { Link } from '@inertiajs/react';

function GameCard({ game }: { game: Game }) {
    return (
        <Card className="bg-base-100 shadow-sm group-hover:shadow-lg">
            <Link href={route('game.show', game.slug)}>
                <figure>
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
                </figure>
            </Link>

            <CardBody>
                <Link href={route('game.show', game.slug)} className="hover:underline">
                    <CardTitle>{game.title}</CardTitle>
                </Link>
                <div className="flex flex-col">
                    <Link href={route('home')} className="hover:underline">
                        {game.developers[0].name}
                    </Link>
                    <Link href={route('home')} className="hover:underline">
                        {game.publishers[0].name}
                    </Link>
                </div>

                <div className="flex gap-2">
                    {game.genres.map((genre) => (
                        <Badge key={genre.id} badgeStyle="outline" size="sm">
                            {genre.name}
                        </Badge>
                    ))}
                </div>
            </CardBody>
        </Card>
    );
}

function GameCardSkeleton() {
    return (
        <div className="flex flex-col gap-4">
            <Skeleton className="h-32 w-full" />
            <Skeleton className="h-4 w-28" />
            <Skeleton className="h-4 w-full" />
            <Skeleton className="h-4 w-full" />
        </div>
    );
}

export { GameCard, GameCardSkeleton };
