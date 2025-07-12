import RadialProgress from '@/components/ui/radial-progress';
import useRatingColor from '@/hooks/use-rating-color';

export default function RatingProgress({ value }: { value: number }) {
    const getColor = useRatingColor();

    return <RadialProgress value={value} color={getColor(value)} />;
}
