import RatingForm from '@/components/rating-form';
import RatingProgress from '@/components/rating-progress';
import ReviewCard from '@/components/review-card';
import { Badge } from '@/components/ui/badge';
import { Loading } from '@/components/ui/loading';
import RadialProgress from '@/components/ui/radial-progress';
import { Stat, StatDesc, StatFigure, Stats, StatTitle, StatValue } from '@/components/ui/stat';
import { AppLayout } from '@/layouts/app-layout';
import { SharedData } from '@/types';
import type { Game, Review } from '@/types/library';
import { Head, Link, usePage, WhenVisible } from '@inertiajs/react';
import moment from 'moment';
import * as React from 'react';

type Props = {
    game: Game;
    reviews: Review[];
};

export default function ShowGame({ game, reviews }: Props) {
    const { auth } = usePage<SharedData>().props;

    return (
        <AppLayout>
            <Head title={game.title} />

            <header className="mx-auto max-w-7xl p-4 lg:p-6">
                <h1 className="text-3xl leading-8 font-semibold text-base-content">{game.title}</h1>
                <h2 className="text-xl font-semibold text-accent">{moment(game.release_date).format('Y')}</h2>

                {/* TODO: must play titles */}
                <div className="mt-4">
                    <Badge size="xl" color="info" badgeStyle="outline">
                        Must play title
                    </Badge>
                </div>

                {/* Grid */}
                <div className="mt-8 grid grid-cols-1 place-items-center gap-8 md:grid-cols-5">
                    <div className="h-full space-y-6 md:col-span-2 lg:col-span-1">
                        {game.cover_art && (
                            <figure className="border border-base-300">
                                <img src={game.cover_art} alt="" />
                            </figure>
                        )}

                        {/* TODO: add placeholder cover art */}

                        {/* Platform badges */}
                        <div className="flex flex-wrap gap-2">
                            {game.platforms.map((platform) => (
                                <Badge key={platform.id} color="neutral">
                                    {platform.name}
                                </Badge>
                            ))}
                        </div>
                    </div>

                    {/* Stats box */}
                    <div className="w-full self-baseline md:col-span-2">
                        <Stats className="w-full border border-base-300 bg-base-200" direction="vertical">
                            <Stat>
                                <StatTitle>Critics rating</StatTitle>
                                <StatFigure>
                                    <RadialProgress value={65} color="warning" />
                                </StatFigure>
                                <StatValue>
                                    65
                                    <span className="text-sm">/100</span>
                                </StatValue>
                                <StatDesc>
                                    Based on <span className="font-bold">12</span> reviews
                                </StatDesc>
                            </Stat>

                            <Stat>
                                <StatTitle>Audience rating</StatTitle>
                                <StatFigure>
                                    <RatingProgress value={Math.round(game.ratings_avg_score)} />
                                </StatFigure>
                                <StatValue>
                                    {Math.round(game.ratings_avg_score)}
                                    <span className="text-sm">/100</span>
                                </StatValue>
                                <StatDesc>
                                    Based on <span className="font-bold">{game.ratings_count}</span> ratings
                                </StatDesc>
                            </Stat>
                        </Stats>
                    </div>

                    <div className="col-span-full w-full space-y-4 lg:col-span-2">
                        <div className="space-y-4 border border-base-300 bg-base-200 p-4">
                            <div>
                                <h2 className="text-lg leading-10">Developers</h2>
                                <div className="text-sm">
                                    {game.developers
                                        .map<React.ReactNode>((developer) => (
                                            <Link href="#" key={developer.id} className="hover:underline">
                                                {developer.name}
                                            </Link>
                                        ))
                                        .reduce((prev, curr) => [prev, ' | ', curr])}
                                </div>
                            </div>

                            <div>
                                <h2 className="text-lg leading-10">Publishers</h2>
                                <div className="text-sm">
                                    {game.publishers
                                        .map<React.ReactNode>((publisher) => (
                                            <Link href="#" key={publisher.id} className="hover:underline">
                                                {publisher.name}
                                            </Link>
                                        ))
                                        .reduce((prev, curr) => [prev, ' | ', curr])}
                                </div>
                            </div>
                        </div>

                        {/* Genres and Tags */}
                        <div className="space-y-4 border border-base-300 bg-base-200 p-4">
                            <div>
                                <h2 className="text-lg leading-10 font-semibold">Release Date</h2>
                                <div className="text-sm">{moment(game.release_date).format('MMM Do, YYYY')}</div>
                            </div>

                            {/* Genres */}
                            <div>
                                <h2 className="text-lg leading-10 font-semibold">Genres</h2>

                                <div className="flex flex-wrap gap-1">
                                    {game.genres.map((genre) => (
                                        <Link href="#" key={genre.id}>
                                            <Badge color="primary" size="sm" className="duration-200 hover:badge-soft">
                                                {genre.name}
                                            </Badge>
                                        </Link>
                                    ))}
                                </div>
                            </div>

                            {/* Tags */}
                            <div>
                                <h2 className="text-lg leading-10 font-semibold">Tags</h2>

                                <div className="flex flex-wrap gap-1">
                                    {game.tags.map((tag) => (
                                        <Link href="#" key={tag.id}>
                                            <Badge color="neutral" size="sm" className="duration-200 hover:badge-outline hover:badge-primary">
                                                {tag.name.en}
                                            </Badge>
                                        </Link>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {/* Description */}
            <div className="divider mx-auto max-w-7xl px-4 text-xl lg:px-6">Description</div>

            <section>
                <div className="mx-auto max-w-7xl p-4 lg:p-6">
                    <div className="border border-base-300 bg-base-200 p-6">{game.description ?? 'No description provided'}</div>
                </div>
            </section>

            {/* Recent user reviews */}
            <div className="divider mx-auto max-w-7xl px-4 text-xl lg:px-6">Recent user reviews</div>

            <section className="mx-auto max-w-7xl space-y-2 p-4 lg:p-6">
                {/* Sign in banner */}
                {!auth.user && (
                    <div className="mb-4 border border-base-300 bg-base-200 p-3 text-center">
                        <p className="text-sm uppercase">
                            <Link href={route('login')} className="font-bold hover:underline">
                                Sign in
                            </Link>{' '}
                            to rate and review
                        </p>
                    </div>
                )}

                {auth.user && (
                    <div className="mb-4 p-3">
                        <div className="flex flex-col items-center">
                            <div className="mb-4 w-full border border-base-300 bg-base-200 p-2">
                                <h1 className="text-center text-sm font-bold uppercase">Add your rating</h1>
                            </div>

                            <div className="w-full md:w-lg">
                                <RatingForm game={game} />
                            </div>
                        </div>
                    </div>
                )}

                {/* TODO: Change loading to skeleton */}
                <WhenVisible
                    data={['reviews']}
                    fallback={
                        <div>
                            <Loading type="bars" />
                        </div>
                    }
                >
                    <>{reviews?.map((review) => <ReviewCard key={review.id} review={review} />)}</>
                </WhenVisible>
            </section>
        </AppLayout>
    );
}
