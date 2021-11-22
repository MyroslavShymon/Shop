const ErrorHandler = (e) => {
    if (e?.response?.data?.message || e?.response?.data?.error || e?.response?.data) {
        let error;
        if (e?.response?.data?.error) {
            error = Object.values(e?.response?.data?.error).map(e => {
                return e[0]
            });
        } else {
            error = Object.values(e?.response?.data).map(e => {
                return e[0]
            });
        }
        return {
            message: e?.response?.data?.message || error.join(' '),
            loading: false,
            error: true
        }
    }
}

export default ErrorHandler;