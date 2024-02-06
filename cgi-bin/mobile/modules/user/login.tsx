// withHooks
import { memo } from 'react';

import { LibCrypt } from 'esoftplay/cache/lib/crypt/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import useSafeState from 'esoftplay/state';
import React, { useEffect } from 'react';
import { Button, Text, View } from 'react-native';


export interface UserLoginArgs {

}
export interface UserLoginProps {

}


export interface ResApi {


    id: string,
    name: string,
    email: string,
    teacher: {
        id: string,
        user_id: string,
        name: string,
        nip: string,
        phone: string,
        position: string,
        image: string,
        created: string,
        updated: string
    },
    course: string[],
    parent: string,
    student: string

}

function m(props: UserLoginProps): any {
    const [resApi, setResApi] = useSafeState<any>();
    let [response, setResponse] = useSafeState()


    // useEffect(() => {
    //     login()
    // }, [])


    function login(username?: any, password?: any) {

        // console.log("eeee")
        const post = {
            // username: "33333",
            // password: "yasin,
            username: new LibCrypt().encode(username ?? ''),
            password: new LibCrypt().encode(password ?? ''),
        }

        // console.log(post)
        LibProgress.show('Loading')
        new LibCurl('public_login', post, (result, msg) => {
            LibProgress.hide(),


                //isi resApi dengan result
                setResApi(result)
            //isi response dengan result
            setResponse(result)


            // console.log("id",result.id);
            // console.log("name",result.name)

            UserClass.create(result).then(() => {
                
            })

            // console.log('Result', result)
            // console.log('Msg',  msg)

        }, (err) => {
            LibProgress.hide()

            console.log("FAILED", err)
        }, 1)
    }
    esp.log(resApi, "lll")
    // console.log("response",response?.teacher?.name)

    return (
        <View style={{ flex: 1, backgroundColor: "orange", paddingTop: 40 }}>
            <Button title="test" onPress={() => login()} />
            <Text>{resApi?.name}</Text>

        </View>
    )
}
export default memo(m);