const ErrorHandler = (e) => {
    if (e?.response?.data?.message || e?.response?.data?.error) {
        let error;
        if (e?.response?.data?.error)
            error = Object.values(e?.response?.data?.error).map(e => {
                return e[0]
            });

        return {
            message: e?.response?.data?.message || error[0],
            loading: false,
            error: true
        }
    }
}

export default ErrorHandler;