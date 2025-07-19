import { useCallback } from 'react';

export default function useRatingColor() {
    return useCallback((value: number) => {
        if (value < 40) {
            return 'error';
        } else if (value >= 40 && value < 70) {
            return 'warning';
        } else {
            return 'success';
        }
    }, []);
}
