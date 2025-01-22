// ChildDetailRaport.tsx

import { memo } from "react";
import React from "react";
import { Text, View, ScrollView, Pressable } from "react-native";
import { LibNavigation } from "esoftplay/cache/lib/navigation/import";
import ReportCardImage from "../components/raport_card"; // Import komponen laporan

export interface ChildDetailRaportProps {}

function ChildDetailRaport(props: ChildDetailRaportProps): JSX.Element {
  // Mengambil data dari navigation args
  const { childdetailraport, kelas } = LibNavigation.getArgsAll(props);

  // Jika data tidak ada, beri pesan error
  if (!childdetailraport) {
    console.error("Error: childDataRaport tidak ada atau tidak terisi");
  }

  return (
    <View style={{ flex: 1 }}>
      <ScrollView showsVerticalScrollIndicator={false}>
        <View
          style={{
            flex: 1,
            backgroundColor: "#4B7AD6",
            borderBottomRightRadius: 20,
            borderBottomLeftRadius: 20,
            padding: 20,
            paddingTop: 40,
          }}
        >
          <View
            style={{
              backgroundColor: "#FFFFFF",
              height: 120,
              justifyContent: "flex-start",
              alignItems: "center",
              marginVertical: 20,
              padding: 15,
              flexDirection: "row",
              borderRadius: 10,
            }}
          >
            <View
              style={{
                marginLeft: 15,
                justifyContent: "center",
                alignItems: "flex-start",
              }}
            >
              <Text
                style={{
                  fontSize: 19,
                  color: "#000000",
                  textAlign: "center",
                  fontWeight: "600",
                }}
              >
                Nama: {childdetailraport?.student_name}
              </Text>
              <Text
                style={{
                  fontSize: 19,
                  color: "#000000",
                  textAlign: "center",
                  fontWeight: "600",
                }}
              >
                {/* clasname */}
                Kelas:{childdetailraport?.class_name}
              </Text>
              <Text
                style={{
                  fontSize: 19,
                  color: "#000000",
                  textAlign: "center",
                  fontWeight: "600",
                }}
              >
                NIS: {childdetailraport?.nis}
              </Text>
            </View>
          </View>
        </View>

        <View style={{ marginLeft: 15, marginTop: 15 }}>
          <Text style={{ fontSize: 20, color: "#000000", fontWeight: "600" }}>
            {kelas}
          </Text>
        </View>

        <ReportCardImage />

        <View
          style={{
            flexDirection: "row",
            justifyContent: "center",
            marginTop: 10,
            marginHorizontal: 41,
          }}
        >
          <Pressable
            onPress={() => {}}
            style={{
              height: 50,
              width: "100%",
              alignItems: "center",
              marginBottom: 15,
              backgroundColor: "#4B7AD6",
              justifyContent: "center",
              borderRadius: 10,
              padding: 10,
            }}
          >
            <Text
              style={{
                fontSize: 18,
                fontWeight: "bold",
                color: "#FFFFFF",
              }}
            >
              Download
            </Text>
          </Pressable>
        </View>
      </ScrollView>
    </View>
  );
}

export default memo(ChildDetailRaport);
