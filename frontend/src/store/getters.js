const getters = {
    app: state => state.app.app,
    token: state => state.auth.token,
    userid: state => state.profile.profile.id,
    userrole: state => state.profile.profile.roles,
    profile: state => state.profile.profile,
    avatar: state => state.profile.profile.avatar,
    loading: state => state.loading,
    fbLoginUrl: state => '/auth/facebook?scope=email,user_location',
    googleLoginUrl: state => '/auth/google',
    getAlertMsg: state => state.alertMsg,
    getAlertType: state => state.alertType,

}
export default getters
