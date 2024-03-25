// withHooks
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React, { useEffect, useRef, useState } from 'react';
import { Image, View, Text, TouchableOpacity, Pressable, TextInput, ScrollView, Modal } from 'react-native';
import { MaterialIcons } from '@expo/vector-icons';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibImage } from 'esoftplay/cache/lib/image/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import esp from 'esoftplay/esp';
import useSafeState from 'esoftplay/state';
import { FlatList } from 'react-native-gesture-handler';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import SchoolColors from '../utils/schoolcolor';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import moment from 'esoftplay/moment';

export interface TeacherDetailArgs {

}
export interface TeacherDetailProps {

}
function m(props: TeacherDetailProps): any {
    const school = new SchoolColors();

    let slideup = useRef<LibSlidingup>(null)
    let [image, setImage] = useSafeState<string | null>(null)
    const [username, setUsername] = useSafeState('');
    const [phone, setPhone] = useSafeState('');
    const [resApi, setResApi] = useState<any>([])
    const [prfilevisible, setProfileVisible] = useState(false)
    useEffect(() => {
        new LibCurl('teacher', null, (result, msg) => {
            esp.log({ result, msg });
            // console.log("result", result)
            setResApi(result)
            setImage(result.image)
        }, (err) => {
            esp.log({ err });
            LibDialog.warning('get data gagal', err?.message)
        })
    }, [])

    function updateData() {
        LibProgress.show()
        const post = {
            name: username,
            image: image,
            phone: phone
        }
        console.log("post", post)
        new LibCurl('teacher_update', post, (result, msg) => {

            LibProgress.hide()
            esp.log({ result, msg });
            // console.log("result", result)



        }, (err) => {
            esp.log({ err });
            LibProgress.hide()
            LibDialog.warning('Update Gagal', err?.message)
        })

        new LibCurl('teacher', null, (result, msg) => {
            esp.log({ result, msg });
            // console.log("result", result)
            setResApi(result)
            setImage(result.image)
            setPhone('+62' + result.phone)
            LibProgress.hide()
            LibDialog.info('Update Berhasil', 'Data berhasil diupdate')
        }, (err) => {
            esp.log({ err });
            LibProgress.hide()
            LibDialog.warning('Update Gagal', err?.message)

        })
    }



    function shadows(value: number) {
        return {
            elevation: 3, // For Android
            shadowColor: '#000', // For iOS
            shadowOffset: { width: 1, height: 5 },
            shadowOpacity: 0.7,
            shadowRadius: value,
        }
    }
    interface ProfilePopupProps {
        visible: boolean,
        onClose: () => void
    }
    function ProfilePopup({ visible, onClose, }: ProfilePopupProps) {
        return (
            <Modal transparent={true} visible={prfilevisible}>
                <Pressable style={{ flex: 1, backgroundColor: 'rgba(0,0,0,0.5)', justifyContent: 'center', alignItems: 'center' }} onPress={onClose}>
                </Pressable>

                <View style={{ width: '80%', borderRadius: 10, padding: 20, justifyContent: 'center', alignItems: 'center', position: 'absolute', top: LibStyle.height / 4, marginHorizontal: '10%' }}>
                    <LibPicture source={image ? { uri: image } : esp.assets('anies.png')} style={{ width: LibStyle.width * 80 / 100, height: LibStyle.width * 80 / 100, borderRadius: (LibStyle.width * 80 / 100) / 2 }} />
                </View>

            </Modal>
        )
    }
    return (
        <View style={{ marginTop: LibStyle.STATUSBAR_HEIGHT, flex: 1, }}>
            <ScrollView showsVerticalScrollIndicator={false} style={{ paddingHorizontal: 20, }}>
                <View style={{ justifyContent: 'flex-start', alignSelf: 'flex-start', marginTop: 5, }}>
                    <TouchableOpacity style={{ alignSelf: 'center', flexDirection: 'row' }} onPress={() => LibNavigation.replace('teacher/index', { page: 'Akun' })}>
                        <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                        <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>kembali</Text>
                    </TouchableOpacity>
                </View>

                <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 10 }}>

                    <View style={{}}>
                        <Pressable onPress={() => setProfileVisible(true)}>
                            <Image source={image ? { uri: image } : esp.assets('anies.png')} style={{ width: 135, height: 135, borderRadius: 135 / 2, borderWidth: 3, borderColor: school.primary }} />
                        </Pressable>
                        <Pressable
                            onPress={() => slideup.current?.show()}
                            style={{
                                position: 'absolute',
                                bottom: 0, right: -5,
                                borderRadius: 45 / 2,
                                backgroundColor: school.primary,
                                width: 45, height: 45, justifyContent: 'center', alignItems: 'center',
                                elevation: 3, shadowColor: '#000',
                                shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2
                            }}>
                            <MaterialIcons name='edit' size={20} color='#FFFFFF' />
                        </Pressable>

                    </View>

                    <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 20, textAlign: 'center', padding: 10 }}>{resApi?.name ?? 'name'}</Text>
                </View>


                <View style={{ marginHorizontal: 10, paddingHorizontal: 5, marginBottom: 50 }}>


                    <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginTop: 30, alignContent: 'flex-start', textAlign: 'left' }}>Posisi</Text>


                    <View style={{ height: 'auto', padding: 5, }}>
                        <FlatList
                            data={resApi?.position}
                            horizontal={true}
                            showsHorizontalScrollIndicator={false}
                            keyExtractor={(item, index) => index.toString()}
                            contentContainerStyle={{ justifyContent: 'center', alignItems: 'center', paddingLeft: 5 }}
                            renderItem={({ item, index }: { item: any, index: number }) => {
                                return (
                                    // <View style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                                    <View style={{ backgroundColor: 'white', padding: 10, width: 'auto', marginRight: 15, borderRadius: 10, ...shadows(3), marginVertical: 5, height: 60, justifyContent: 'center', alignItems: 'center' }}>
                                        <Text style={{ fontSize: 15, fontWeight: 'bold', }}>{item}</Text>
                                    </View>
                                )
                            }}
                        />
                    </View>

                    <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 10, alignContent: 'flex-start', textAlign: 'left' }}>Nama Pengajar</Text>
                    <View style={{
                        width: '100%', height: 60, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', justifyContent: 'space-between', alignItems: 'center',
                        shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row'
                    }}>
                        <TextInput placeholder={resApi?.name ?? 'name'}
                            style={{ flex: 1 }}
                            onChangeText={(text) => setUsername(text)}
                        />


                    </View>


                    <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>NIP Pengajar</Text>

                    <View style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, backgroundColor: '#cecece8c', }}>
                        <Text style={{ alignContent: 'flex-start', textAlign: 'left', }}>{resApi?.nip ?? 'nip'}</Text>
                    </View>

                    <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>Tanggal Lahir</Text>
                    <View style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, backgroundColor: '#cecece8c', }}>
                        <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#000000' }}>{moment(resApi?.birthday).format('dddd, DD MMMM YYYY')}</Text>
                    </View>

                    <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, alignContent: 'flex-start', textAlign: 'left' }}>Nomor Telepon</Text>

                    <View style={{
                        width: '100%', height: 60, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', justifyContent: 'space-between', alignItems: 'center',
                        shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, flexDirection: 'row'
                    }}>
                        <TextInput placeholder={'+' + resApi?.phone ?? '+62'}
                            style={{ flex: 1 }}
                            onChangeText={(text) => setPhone(text)}
                        />


                    </View>

                    <Pressable onPress={() => LibDialog.confirm(' ', 'Apakah anda yakin untuk mengubah data?', 'ya', () => updateData(), 'tidak', () => { })} style={{ width: '100%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#107ac0', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2, marginTop: 15 }}>
                        <Text style={{ alignContent: 'flex-start', textAlign: 'center', color: '#ffffff' }}>Update Data</Text>
                    </Pressable>
                </View>
            </ScrollView>
            <ProfilePopup visible={prfilevisible} onClose={() => setProfileVisible(false)} />
            <LibSlidingup ref={slideup} >
               <View style={{ padding: 10,backgroundColor: '#ffffff',borderTopRightRadius: 20, borderTopLeftRadius: 20,paddingHorizontal: 20,paddingVertical:20  }}>
               <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}> Ganti Foto Profil</Text>
                <View style={{  paddingBottom: 25,  justifyContent: 'space-evenly', flexDirection: 'row', paddingVertical: 20 }}>
                    <Pressable
                        style={{ justifyContent: 'center', alignItems: 'center' }}
                        onPress={() =>
                            LibImage.fromCamera({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                slideup.current!.hide()
                                setImage(url)
                            })} >
                        <View style={{ width: 60, height: 60, backgroundColor: '#ffffff', borderRadius: 50, justifyContent: 'center', alignItems: 'center', borderColor: school.primary, borderWidth: 2, marginBottom: 10 }}>
                            <LibIcon.MaterialIcons name="camera-alt" size={30} color="#136B93" />
                        </View>
                        <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>Kamera</Text>
                    </Pressable>

                    <Pressable
                        style={{ justifyContent: 'center', alignItems: 'center' }}
                        onPress={() =>
                            LibImage.fromGallery({ crop: { ratio: "1:1", forceCrop: true } }).then((url) => {
                                esp.log(url)
                                console.log("url", url)
                                slideup.current!.hide()
                                setImage(String(url))
                            })
                        } >
                        <View style={{ width: 60, height: 60, backgroundColor: '#ffffff', borderRadius: 50, justifyContent: 'center', alignItems: 'center', borderColor: school.primary, borderWidth: 2, marginBottom: 10 }}>
                            <LibIcon.MaterialIcons name="image" size={30} color="#136B93" />
                        </View>
                        <Text style={{ color: '#000000', fontSize: 20, fontWeight: 'bold' }}>Galeri</Text>

                    </Pressable>

                </View>
                </View>
            </LibSlidingup>
        </View>
    )
}
export default m
